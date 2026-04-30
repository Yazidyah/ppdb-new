<x-guest-layout>
    <h2 class="text-xl font-bold text-tertiary text-center mb-4 tracking-wide">Lupa Password</h2>

    <p class="mb-6 text-sm text-gray-500 text-center">
        {{ __('Lupa kata sandi? Jangan khawatir. Masukkan email Anda, dan kami akan bantu Anda mengatur ulang.') }}
    </p>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form id="forgotPasswordForm" method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                </span>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                    required autofocus
                    placeholder="nama@email.com"
                    class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl shadow-sm text-sm focus:outline-none focus:ring-2 focus:ring-tertiary focus:border-tertiary transition" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <span id="countdownDisplay" class="text-sm text-gray-500" style="display: none;"></span>
            <button id="submitBtn" type="submit"
                class="w-full py-3 px-4 bg-tertiary hover:bg-primary text-white font-bold rounded-xl shadow-md transition duration-200 text-sm tracking-wide">
                {{ __('Kirim Link Pemulihan') }}
            </button>
        </div>

        <p class="text-center text-sm text-gray-600">
            Ingat passwordnya?
            <a href="{{ route('login') }}" class="text-tertiary font-semibold hover:underline">Masuk</a>
        </p>
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
                    submitBtn.textContent = '{{ __("Kirim Link Pemulihan") }}';
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
                    submitBtn.textContent = '{{ __("Kirim Link Pemulihan") }}';
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
