<x-guest-layout>
    {{-- @if (session('status') === 'verification-required')
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Silakan verifikasi email Anda sebelum melanjutkan.') }}
        </div>
    @endif
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('User Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600  hover:text-gray-900  rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-tertiary dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Pernah Mendaftar?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Daftar') }}
            </x-primary-button>
        </div>
    </form> --}}
    <div class="text-center mt-6">
        <p class="text-xl text-red-600 font-bold">
            {{ __('Registrasi telah ditutup. Silahkan lakukan login untuk mengakses pendaftaran.') }}
        </p>
        <a href="{{ route('login') }}"
            class="mt-6 inline-block w-full px-6 py-3 bg-tertiary text-white text-center font-bold rounded-lg shadow-md hover:bg-primary focus:outline-none focus:ring-2 focus:ring-tertiary focus:ring-offset-2 transition">
            {{ __('Login') }}
        </a>
        </a>
    </div>
</x-guest-layout>
