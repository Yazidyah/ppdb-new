<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased" id="bg-error-web">
    <div class="flex flex-col min-h-full pt-16 pb-12 bg-white">
        <main class="flex flex-col justify-center flex-grow w-full max-w-xl px-6 mx-auto lg:px-8">

            <div class="py-16">
                <div class="text-center">
                    <a href="/" class="flex flex-col justify-center items-center">
                        <img src="/logoman.webp" class="w-20 h-20 justify-center items-center fill-current">
                        <h1 class="text-xl fill-current text-gray-700 font-bold text-center mt-2">PPDB MAN 1 Kota Bogor
                        </h1>
                    </a>
                </div>
                <div class="text-left">
                    <p class="text-2xl font-bold text-indigo-600">
                        @yield('code')
                    </p>
                    <h1 class="my-1 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">
                        @yield('title')
                    </h1>
                    @php
                        $route = request()->route() ?? '';
                        $fingerprint = request()->route() ? request()->fingerprint() : '';
                    @endphp
                    @if ($route && $fingerprint)
                        <div
                            class="relative p-2 my-4 text-sm text-gray-500 break-all bg-gray-100 border border-gray-300 rounded-lg">
                            <p>Timestamp: {{ now()->toDateTimeString() }}</p>
                            <p>Fingerprint: {{ $fingerprint }} - {{ auth()->id() ?? '' }}</p>
                        </div>
                    @else
                        <div
                            class="relative p-2 my-4 text-sm text-gray-500 bg-gray-100 border border-gray-300 rounded-lg">
                            <p>Timestamp: {{ now()->toDateTimeString() }}</p>
                        </div>
                    @endif
                    <p class="mt-2 text-base text-gray-500">
                        @yield('message')
                    </p>
                    <div class="my-6">
                        <a href="/" class="text-base font-medium text-indigo-600 hover:text-indigo-500">
                            Go back home
                            <span aria-hidden="true"> &rarr;</span>
                        </a>
                    </div>
                    <span class="inline-flex">
                        <span class="sr-only">@yield('title')</span>
                    </span>
                </div>
            </div>
        </main>
    </div>
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
</body>

</html>
