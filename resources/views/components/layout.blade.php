<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/flickity.css" rel="stylesheet" media="screen">
    <link href="logoman.png" type="image/png" rel="icon" >
    @vite(['resources/css/app.css','resources/js/app.js'])
    
    <title>MAN 1 KOTA BOGOR</title>
</head>
<body>
   
<x-navbar></x-navbar>
<main>
                {{ $slot }}
                <x-javascript></x-javascript>
            </main>
</body>
</html>