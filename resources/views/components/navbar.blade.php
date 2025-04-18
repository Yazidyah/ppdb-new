<div class=" bg-tertiary mx-auto w-full sticky z-10 top-0 right-0 left-0">
    <!-- Navigation -->
    <nav class="flex justify-between items-center container mx-auto">
        <a href="/" class=" flex items-center gap-4 justify-center px-6">
            <img class="w-10 " src="logoman.webp" alt="">
            <div class="">
                <h1 class=" text-xl font-bold text-white font-poppins">PPDB</h1>
                <h1 class=" text-xl font-bold text-white font-poppins">MAN 1 KOTA BOGOR</h1>
            </div>
        </a>
        <div class="items-center flex">
            <div class="">
                <ul class="text-white text-xs xl:text-base font-semibold lg:flex gap-4 hidden">
                    <li
                        class="hover:bg-secondary hover:text-primary focus-scale-95 transition-all duration-200 ease-out p-2 rounded-lg">
                        <a href="/">Beranda</a>
                    </li>
                    <li
                        class="hover:bg-secondary hover:text-primary focus-scale-95 transition-all duration-200 ease-out p-2 rounded-lg">
                        <a href="/persyaratan">Persyaratan</a>
                    </li>
                    <li
                        class="hover:bg-secondary hover:text-primary focus-scale-95 transition-all duration-200 ease-out p-2 rounded-lg">
                        <a href="/alurpendaftaran">Alur Pendaftaran</a>
                    </li>
                    <li class="border-l py-3"></li>
                </ul>
            </div>
            <div class="py-4 pl-6 lg:flex hidden gap-4">
                @if (Auth::check())
                    <a href="{{ route('siswa.dashboard') }}"
                        class="text-white outline px-9 py-4 rounded-full font-bold text-sm hover:bg-secondary hover:text-primary">Dashboard</a>
                @else
                    <a href="login"
                        class="text-white outline-secondary outline px-7 flex items-center justify-center rounded-full font-bold text-xs xl:text-base hover:bg-white hover:text-primary">Masuk</a>
                    <a href="register"
                        class="flex items-center justify-center w-full text-sm font-bold px-9 py-4 bg-white rounded-full hover:bg-secondary hover:text-primary text-primary">Daftar</a>
                @endif
            </div>
        </div>

        <button class="py-4 px-6 lg:hidden block buttonDown text-white">
            <svg width="65" height="65" viewBox="0 0 65 65" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M9.38297 55.6177C13.3534 59.5827 19.7342 59.5827 32.5013 59.5827C45.2684 59.5827 51.6519 59.5827 55.6169 55.615C59.5846 51.6527 59.5846 45.2664 59.5846 32.4994C59.5846 19.7323 59.5846 13.3487 55.6169 9.38102C51.6546 5.41602 45.2684 5.41602 32.5013 5.41602C19.7342 5.41602 13.3507 5.41602 9.38297 9.38102C5.41797 13.3514 5.41797 19.7323 5.41797 32.4994C5.41797 45.2664 5.41797 51.6527 9.38297 55.6177ZM50.7826 43.3327C50.7826 43.8714 50.5686 44.3881 50.1876 44.769C49.8067 45.1499 49.29 45.3639 48.7513 45.3639H16.2513C15.7126 45.3639 15.1959 45.1499 14.815 44.769C14.4341 44.3881 14.2201 43.8714 14.2201 43.3327C14.2201 42.794 14.4341 42.2773 14.815 41.8964C15.1959 41.5154 15.7126 41.3014 16.2513 41.3014H48.7513C49.29 41.3014 49.8067 41.5154 50.1876 41.8964C50.5686 42.2773 50.7826 42.794 50.7826 43.3327ZM48.7513 34.5306C49.29 34.5306 49.8067 34.3166 50.1876 33.9357C50.5686 33.5547 50.7826 33.0381 50.7826 32.4994C50.7826 31.9606 50.5686 31.444 50.1876 31.063C49.8067 30.6821 49.29 30.4681 48.7513 30.4681H16.2513C15.7126 30.4681 15.1959 30.6821 14.815 31.063C14.4341 31.444 14.2201 31.9606 14.2201 32.4994C14.2201 33.0381 14.4341 33.5547 14.815 33.9357C15.1959 34.3166 15.7126 34.5306 16.2513 34.5306H48.7513ZM50.7826 21.666C50.7826 22.2047 50.5686 22.7214 50.1876 23.1023C49.8067 23.4833 49.29 23.6973 48.7513 23.6973H16.2513C15.7126 23.6973 15.1959 23.4833 14.815 23.1023C14.4341 22.7214 14.2201 22.2047 14.2201 21.666C14.2201 21.1273 14.4341 20.6106 14.815 20.2297C15.1959 19.8488 15.7126 19.6348 16.2513 19.6348H48.7513C49.29 19.6348 49.8067 19.8488 50.1876 20.2297C50.5686 20.6106 50.7826 21.1273 50.7826 21.666Z"
                    fill="white" />
            </svg>
        </button>
    </nav>
    <div class="mobileMenu hidden xl:hidden">
        <ul class=" text-sm text-center font-bold gap-8">
            <li
                class="text-white hover:bg-secondary hover:text-primary focus-scale-95 transition-all duration-200 ease-out p-2 rounded-lg">
                <a href="/">Beranda</a>
            </li>
            <li
                class="text-white hover:bg-secondary hover:text-primary focus-scale-95 transition-all duration-200 ease-out p-2 rounded-lg">
                <a href="/persyaratan">Persyaratan</a>
            </li>
            <li
                class="text-white hover:bg-secondary hover:text-primary focus-scale-95 transition-all duration-200 ease-out p-2 rounded-lg">
                <a href="/alurpendaftaran">Alur Pendaftaran</a>
            </li>
        </ul>
        <div class=" flex justify-center gap-4 px-4 pb-4 mt-4">
        @if (Auth::check())
                    <a href="{{ route('siswa.dashboard') }}"
                        class="text-white  outline px-9 py-4 rounded-full font-bold text-sm hover:bg-secondary hover:text-primary">Dashboard</a>
                @else
                <div class="flex justify-between gap-4 px-4 pb-4 mt-4">
                    <a href="login"
                        class="text-white outline-secondary outline px-7 flex items-center justify-center rounded-full font-bold text-xs xl:text-base hover:bg-white hover:text-primary">Masuk</a>
                    <a href="register"
                        class="flex items-center justify-center w-full text-sm font-bold px-9 py-4 bg-white rounded-full hover:bg-secondary hover:text-primary text-primary">Daftar</a>
                </div>
                @endif
        </div>
    </div>
</div>
