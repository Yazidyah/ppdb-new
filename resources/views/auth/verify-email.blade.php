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

            <div>
                <x-primary-button id="resend-btn">
                    {{ __('Kirim Ulang Email Verifikasi') }}
                </x-primary-button>
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
        // Helper untuk set cookie
        function setCookie(name, value, days) {
            let expires = "";
            if (days) {
                const date = new Date();
                date.setTime(date.getTime() + (days*24*60*60*1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "")  + expires + "; path=/";
        }

        // Helper untuk get cookie
        function getCookie(name) {
            const nameEQ = name + "=";
            const ca = document.cookie.split(';');
            for(let i=0;i < ca.length;i++) {
                let c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1,c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
            }
            return null;
        }

        // Helper untuk hash string dengan SHA-256 dan hasil hex
        async function sha256(str) {
            const buf = new TextEncoder().encode(str);
            const hashBuffer = await crypto.subtle.digest('SHA-256', buf);
            const hashArray = Array.from(new Uint8Array(hashBuffer));
            return hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const resendBtn = document.getElementById('resend-btn');
            const resendForm = document.getElementById('resend-form');
            const cookieName = 'ppdb_man_1_kota_bogor_verification';
            // Ganti dengan email user jika tersedia, atau string unik lain
            const userIdentifier = "{{ Auth::user()->email ?? 'user' }}";

            // Fungsi utama untuk handle tombol dan cookie
            async function handleResendButton() {
                const hashValue = await sha256(userIdentifier);

                // Cek cookie, jika sudah ada, disable tombol dan ubah teks
                if (getCookie(cookieName) === hashValue) {
                    resendBtn.disabled = true;
                    resendBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
                    resendBtn.innerText = 'Batas pengiriman habis, cek email anda';
                }

                resendBtn?.addEventListener('click', async function(e) {
                    const hashValue = await sha256(userIdentifier);
                    setCookie(cookieName, hashValue, 1);
                    resendBtn.disabled = true;
                    resendBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
                    resendBtn.innerText = 'Batas pengiriman habis, cek email anda';
                });

                resendForm?.addEventListener('submit', async function(e) {
                    const hashValue = await sha256(userIdentifier);
                    if (getCookie(cookieName) === hashValue) {
                        e.preventDefault();
                        return false;
                    }
                    // Tidak perlu setCookie lagi di sini, sudah di-handle saat klik
                });
            }

            handleResendButton();
        });
    </script>
</x-guest-layout>
