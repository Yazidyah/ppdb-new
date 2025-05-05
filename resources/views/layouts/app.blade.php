@php
    $userRole = Auth::user()->role;
    $redirectUrl = 'navigation';

    switch ($userRole) {
        //Admin
        case 'admin':
            $redirectUrl = 'layouts.navigation';
            break;
        //Pembina
        case 'operator':
            $redirectUrl = 'layouts.navigation-op';
            break;

        default:
            $redirectUrl = 'layouts.navigation';

            break;
    }
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-NG6ZPNFX66"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-NG6ZPNFX66');
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/path/to/flickity.css" media="screen">
    <link rel="icon" type="image/png" sizes="32x32" href="/logoman.webp">
    <title>{{ config('app.name', 'MAN 1 KOTA BOGOR') }}</title>
    <meta name="description" content="Penerimaan Peserta Didik Baru Man 1 Kota Bogor.">
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="PPDB MAN 1 Kota Bogor">
    <meta property="og:description" content="Penerimaan Peserta Didik Baru Man 1 Kota Bogor.">
    <meta property="og:image" content="{{ '/logoman.webp' }}">
    <meta property="og:image:alt" content="Logo Man 1 Kota Bogor">
    <meta property="og:locale" content="id_ID">
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ Request::url() }}">
    <meta name="twitter:title" content="PPDB MAN 1 Kota Bogor">
    <meta name="twitter:description" content="Penerimaan Peserta Didik Baru Man 1 Kota Bogor.">
    <meta name="twitter:image" content="{{ '/logoman.webp' }}">
    <meta name="twitter:image:alt" content="Logo Man 1 Kota Bogor">

    @yield('meta')


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script> --}}


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include($redirectUrl)

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    @livewireScripts

</body>

</html>
