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
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
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
</x-guest-layout>
