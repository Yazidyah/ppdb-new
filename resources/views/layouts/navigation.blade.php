@php
    $userRole = Auth::user()->role;
    $redirectUrl = 'dashboard';

switch ($userRole){
    //Admin
    case 'admin':
    $redirectUrl = 'admin.dashboard';
    $redirectUrlp = 'admin.alur-pendaftaran';
    $redirectUrlk = 'admin.persyaratan';
    $redirectUrlpk = 'admin.dashboard';
    $redirectUrlc = 'admin.dashboard';
    break;
    //Operator
    case 'operator':
    $redirectUrl = 'operator.dashboard';
    $redirectUrlp = 'operator.alurpendaftaran';
    $redirectUrlk = 'operator.persyaratan';
    $redirectUrlpk = 'operator.dashboard';
    $redirectUrlc = 'operator.dashboard';
    break;

    default:
    $redirectUrl = 'siswa.dashboard';
    $redirectUrlp = 'siswa.alurpendaftaran';
    $redirectUrlk = 'siswa.persyaratan';
    $redirectUrlpk = 'siswa.dashboard';
    $redirectUrlc = 'siswa.dashboard';
    break;

}
@endphp


<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-tertiary mx-auto w-full right-0 left-0">
    <!-- Primary Navigation Menu -->
    <div class="flex justify-between items-center container mx-auto">
       
            
                <!-- Logo -->
                <div x-data="{cheat:false}" class="flex items-center gap-1 justify-center px-6">
                    <a href={{ route($redirectUrl) }}>
                        <x-application-logo class=" h-9 w-auto fill-current text-gray-800 " />
                    </a>
                </div>
            <div class="flex">
                <!-- Navigation Links -->
                <div class="items-center justify-center flex">
                <div class=" text-white text-xs xl:text-base font-semibold lg:flex gap-4 hidden">
                    <x-nav-link :href="route($redirectUrl)" :active="request()->routeIs($redirectUrl)">
                        {{ __('Beranda') }} 
                    </x-nav-link>
                    <x-nav-link :href="route($redirectUrlp)" :active="request()->routeIs($redirectUrlp)">
                        {{ __('Alur Pendaftaran') }} 
                    </x-nav-link>
                    <x-nav-link :href="route($redirectUrlk)" :active="request()->routeIs($redirectUrlk)">
                        {{ __('Persyaratan') }} 
                    </x-nav-link>
                    <div class="border-l py-3" ></div>
                </div>
            </div>
            
            
            <!-- Settings Dropdown -->
            <div class="py-4 pl-6 lg:flex hidden gap-4">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center  border border-transparent  leading-4 bg-dasar  focus:outline-none transition ease-in-out duration-150 hover:bg-white text-white outline-dasar outline px-7 py-3 rounded-full font-bold text-xs xl:text-base hover:text-tertiary ">
                            <img src="/logoman.webp" class="w-5">
                            <div class="text-base ml-2" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>

                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="py-4 px-6 lg:hidden block text-white content">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-dasar  focus:outline-none 0  focus:text-dasar  transition duration-150 ease-in-out">
                <svg width="65" height="65" viewBox="0 0 65 65" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.38297 55.6177C13.3534 59.5827 19.7342 59.5827 32.5013 59.5827C45.2684 59.5827 51.6519 59.5827 55.6169 55.615C59.5846 51.6527 59.5846 45.2664 59.5846 32.4994C59.5846 19.7323 59.5846 13.3487 55.6169 9.38102C51.6546 5.41602 45.2684 5.41602 32.5013 5.41602C19.7342 5.41602 13.3507 5.41602 9.38297 9.38102C5.41797 13.3514 5.41797 19.7323 5.41797 32.4994C5.41797 45.2664 5.41797 51.6527 9.38297 55.6177ZM50.7826 43.3327C50.7826 43.8714 50.5686 44.3881 50.1876 44.769C49.8067 45.1499 49.29 45.3639 48.7513 45.3639H16.2513C15.7126 45.3639 15.1959 45.1499 14.815 44.769C14.4341 44.3881 14.2201 43.8714 14.2201 43.3327C14.2201 42.794 14.4341 42.2773 14.815 41.8964C15.1959 41.5154 15.7126 41.3014 16.2513 41.3014H48.7513C49.29 41.3014 49.8067 41.5154 50.1876 41.8964C50.5686 42.2773 50.7826 42.794 50.7826 43.3327ZM48.7513 34.5306C49.29 34.5306 49.8067 34.3166 50.1876 33.9357C50.5686 33.5547 50.7826 33.0381 50.7826 32.4994C50.7826 31.9606 50.5686 31.444 50.1876 31.063C49.8067 30.6821 49.29 30.4681 48.7513 30.4681H16.2513C15.7126 30.4681 15.1959 30.6821 14.815 31.063C14.4341 31.444 14.2201 31.9606 14.2201 32.4994C14.2201 33.0381 14.4341 33.5547 14.815 33.9357C15.1959 34.3166 15.7126 34.5306 16.2513 34.5306H48.7513ZM50.7826 21.666C50.7826 22.2047 50.5686 22.7214 50.1876 23.1023C49.8067 23.4833 49.29 23.6973 48.7513 23.6973H16.2513C15.7126 23.6973 15.1959 23.4833 14.815 23.1023C14.4341 22.7214 14.2201 22.2047 14.2201 21.666C14.2201 21.1273 14.4341 20.6106 14.815 20.2297C15.1959 19.8488 15.7126 19.6348 16.2513 19.6348H48.7513C49.29 19.6348 49.8067 19.8488 50.1876 20.2297C50.5686 20.6106 50.7826 21.1273 50.7826 21.666Z" fill="white"/>
                        </svg>
                </button>
            </div>
    </div>
</div>
    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden">
        <div class=" pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route($redirectUrl)" :active="request()->routeIs($redirectUrl)">
                {{ __('Beranda') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route($redirectUrlp)" :active="request()->routeIs($redirectUrlp)">
                {{ __('Alur Pendaftaran') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route($redirectUrlk)" :active="request()->routeIs($redirectUrlk)">
                {{ __('Persyaratan') }}
            </x-responsive-nav-link>
           
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-dasar">
            <div class="px-4">
                <div class="font-medium text-base text-white" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm text-gray-300">{{ auth()->user()->email }}</div>
            </div>

            <div class=" mt-3 space-y-1">
            <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

            </div>
        </div>
    </div>
</nav>
