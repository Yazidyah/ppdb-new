@php
    $userRole = Auth::user()->role;
    $redirectUrl = 'navigation';

    switch ($userRole) {
        //Admin
        case 'admin':
            $redirectUrl = 'layouts.navigation-op';
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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/path/to/flickity.css" media="screen">
    <link rel="icon" type="image/png" sizes="32x32" href="/logoman.webp">
    <title>{{ config('app.name', 'MAN 1 KOTA BOGOR') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>



    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 ">


        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white  shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset
        <x-logo-horizontal></x-logo-horizontal>
        <x-javascript></x-javascript>
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    @livewireScripts

</body>

</html>
