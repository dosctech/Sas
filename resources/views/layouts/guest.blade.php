<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .custom-container {
            min-height: 90vh; 
            padding-top: 24px; 
            padding-bottom: 24px; 
            width: 100%; 
            max-width: 800px; 
            margin: auto; 
            display: flex; 
            flex-direction: column; 
            justify-content: center; 
            align-items: center; 
        }

        h1 {
            text-align: center; /* Center the text */
            margin: 0; /* Remove default margin */
            font-size: 2rem; /* Adjust font size as needed */
            color: #343a40; /* Set a color for the text (optional) */
        }
    </style>
</head>
<body>
    <div class="custom-container">
        <div>
            <div class="logo-container">
                <img src="{{ asset('image/UniLogo.png') }}" alt="University Logo" class="logo" />
            </div>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg border border-green-500">
            <h1>Administrator</h1> <!-- Centered Header -->
            {{ $slot }}
        </div>
    </div>
</body>
</html>
