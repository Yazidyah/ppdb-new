<x-guest-layout>
    <div class="mb-4 text-sm text-tertiary">
        {{ __('Lupa kata sandi? Jangan khawatir. Masukkan email Anda, dan kami akan bantu Anda mengatur ulang.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form id="forgotPasswordForm" method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <span id="countdownDisplay" class="mr-3 text-sm text-gray-600" style="display: none;"></span>
            <x-primary-button id="submitBtn" type="submit">
                {{ __('Link Pemulihan Kata Sandi Email') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        const form = document.getElementById('forgotPasswordForm');
        const submitBtn = document.getElementById('submitBtn');
        const countdownDisplay = document.getElementById('countdownDisplay');
        const COUNTDOWN_TIME = 90; // 90 seconds
        const STORAGE_KEY = 'passwordResetCooldown';
        let remainingTime = 0;
        let countdownInterval = null;

        // Check cooldown on page load
        function checkCooldown() {
            const storedTime = localStorage.getItem(STORAGE_KEY);
            if (storedTime) {
                const elapsedTime = Math.floor((Date.now() - parseInt(storedTime)) / 1000);
                remainingTime = COUNTDOWN_TIME - elapsedTime;

                if (remainingTime > 0) {
                    // Still in cooldown period
                    startCountdown(remainingTime);
                } else {
                    // Cooldown finished
                    localStorage.removeItem(STORAGE_KEY);
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-50', 'cursor-not-allowed', 'bg-gray-400');
                    submitBtn.textContent = '{{ __("Link Pemulihan Kata Sandi Email") }}';
                    countdownDisplay.style.display = 'none';
                }
            }
        }

        function startCountdown(initialTime = COUNTDOWN_TIME) {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed', 'bg-gray-400');
            submitBtn.textContent = 'Silakan Cek Email';
            remainingTime = initialTime;
            
            countdownDisplay.style.display = 'inline';
            updateCountdown();

            if (countdownInterval) {
                clearInterval(countdownInterval);
            }

            countdownInterval = setInterval(function() {
                remainingTime--;
                updateCountdown();

                if (remainingTime <= 0) {
                    clearInterval(countdownInterval);
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-50', 'cursor-not-allowed', 'bg-gray-400');
                    submitBtn.textContent = '{{ __("Link Pemulihan Kata Sandi Email") }}';
                    countdownDisplay.style.display = 'none';
                    localStorage.removeItem(STORAGE_KEY);
                }
            }, 1000);
        }

        function updateCountdown() {
            const minutes = Math.floor(remainingTime / 60);
            const seconds = remainingTime % 60;
            countdownDisplay.textContent = `(${minutes}:${seconds.toString().padStart(2, '0')})`;
        }

        form.addEventListener('submit', function(e) {
            // Save timestamp to localStorage
            localStorage.setItem(STORAGE_KEY, Date.now().toString());
            startCountdown();
        });

        // Check cooldown when page loads
        document.addEventListener('DOMContentLoaded', checkCooldown);
    </script>
</x-guest-layout>
