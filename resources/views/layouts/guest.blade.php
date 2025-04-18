<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" sizes="32x32" href="/logoman.webp">
        <title>{{ config('app.name', 'MAN 1 KOTA BOGOR') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
    <div class="relative min-h-screen flex flex-col sm:justify-center bg-cover bg-center items-center pt-6 sm:pt-0 bg-no-repeat bg-[url('/public/alur.jpeg')]">
        
        <!-- Overlay hitam transparan -->
        <div class="absolute inset-0 bg-black bg-opacity-40 z-0"></div>

        <!-- Konten utama di atas overlay -->
        <div class="relative z-10">
            <a href="/" class="flex flex-col justify-center items-center">
                <img src="/logoman.webp" class="w-40">
                <h1 class="text-3xl text-white font-bold text-center mt-4">PPDB MAN 1 Kota Bogor</h1>
            </a>
        </div>

        <div class="relative z-10 w-full sm:max-w-md mt-4 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
