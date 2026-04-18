<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 ">
        {{ __('Terima kasih sudah bergabung! Verifikasi email Anda dengan klik tautan di email yang baru kami kirim. Belum menerima emailnya? Klik di sini untuk kirim ulang.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 ">
            {{ __('Kami baru saja mengirimkan tautan verifikasi ke email Anda. Mohon cek email Anda untuk melanjutkan.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}" id="resend-form">
            @csrf

            <div class="flex items-center">
                <x-primary-button id="resend-btn" type="submit">
                    {{ __('Kirim Ulang Email Verifikasi') }}
                </x-primary-button>
                <span id="resend-countdown" class="ml-3 text-sm text-gray-600" style="display: none;"></span>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600  hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ">
                {{ __('Keluar') }}
            </button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const resendBtn = document.getElementById('resend-btn');
            const resendForm = document.getElementById('resend-form');
            const countdownDisplay = document.getElementById('resend-countdown');
            const COUNTDOWN_TIME = 90;
            const userIdentifier = "{{ Auth::user()->email ?? 'user' }}";
            const STORAGE_KEY = `verificationCooldown_${userIdentifier}`;
            let remainingTime = 0;
            let countdownInterval = null;

            function updateButtonState(isDisabled) {
                resendBtn.disabled = isDisabled;
                resendBtn.classList.toggle('bg-gray-400', isDisabled);
                resendBtn.classList.toggle('cursor-not-allowed', isDisabled);
                resendBtn.classList.toggle('opacity-50', isDisabled);
                resendBtn.innerText = isDisabled ? 'Silakan Cek Email' : 'Kirim Ulang Email Verifikasi';
            }

            function updateCountdown() {
                const minutes = Math.floor(remainingTime / 60);
                const seconds = remainingTime % 60;
                countdownDisplay.textContent = `(${minutes}:${seconds.toString().padStart(2, '0')})`;
            }

            function startCountdown(initialTime = COUNTDOWN_TIME) {
                remainingTime = initialTime;
                updateButtonState(true);
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
                        localStorage.removeItem(STORAGE_KEY);
                        countdownDisplay.style.display = 'none';
                        updateButtonState(false);
                    }
                }, 1000);
            }

            function restoreCountdown() {
                const storedTime = localStorage.getItem(STORAGE_KEY);

                if (!storedTime) {
                    updateButtonState(false);
                    countdownDisplay.style.display = 'none';
                    return;
                }

                const elapsedTime = Math.floor((Date.now() - parseInt(storedTime)) / 1000);
                const timeLeft = COUNTDOWN_TIME - elapsedTime;

                if (timeLeft > 0) {
                    startCountdown(timeLeft);
                } else {
                    localStorage.removeItem(STORAGE_KEY);
                    countdownDisplay.style.display = 'none';
                    updateButtonState(false);
                }
            }

            resendForm.addEventListener('submit', function() {
                localStorage.setItem(STORAGE_KEY, Date.now().toString());
                startCountdown();
            });

            restoreCountdown();

            @if (session('status') == 'verification-link-sent')
                if (!localStorage.getItem(STORAGE_KEY)) {
                    localStorage.setItem(STORAGE_KEY, Date.now().toString());
                }
                restoreCountdown();
            @endif
        });
    </script>
</x-guest-layout>
