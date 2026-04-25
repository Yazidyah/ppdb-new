<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/flickity.css" rel="stylesheet" media="screen">
    <link href="logoman.png" type="image/png" rel="icon">
    {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script> --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>PPDB MAN 1 KOTA BOGOR</title>
    
    <style>
        /* Custom animations */
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }
        
        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }
        
        /* Scroll margin for anchor links to avoid navbar overlap */
        [id] {
            scroll-margin-top: 120px;
        }
        
        /* Ensure navbar is always on top */
        nav, .sticky {
            position: relative;
            z-index: 9999 !important;
        }
        
        /* Ensure all sections respect navbar space */
        section, .container {
            position: relative;
            z-index: 1;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #006316;
            border-radius: 5px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #00451c;
        }
    </style>
</head>

<body class="bg-gray-50">

    <x-navbar></x-navbar>
    <main>
        {{ $slot }}
        <x-javascript></x-javascript>
    </main>
</body>

</html>
