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
        /* Parent container to center the content */
        .page-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Full viewport height */
            background-color: #f0f4f8; /* Light background for the page */
        }

        /* Custom styling for the centered content */
        .custom-container {
            width: 100%;
            max-width: 500px;
            padding: 25px;
            background-color: #f9f9f9;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            border: 1px solid #28a745; /* Green border */
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        /* Hover effect */
        .custom-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        /* Logo styling */
        .logo-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .logo {
            max-width: 350px; /* Increased size */
            height: auto;
        }

        /* Styling for h2 */
        h2 {
            font-size: 24px;
            font-weight: 600;
            color: #2d3748; /* Dark gray color */
            text-align: center;
            line-height: 1.5;
            margin-bottom: 20px;
            border-bottom: 2px solid #28a745; /* Green underline */
            padding-bottom: 10px;
        }

        /* Responsive design for smaller screens */
        @media (max-width: 640px) {
            .custom-container {
                padding: 20px;
                max-width: 100%;
            }

            h2 {
                font-size: 20px; /* Slightly smaller on small screens */
            }
        }
    </style>
</head>
<body>
    <div class="page-container">
        <!-- Logo placed outside the container -->
        <div class="logo-container">
            <img src="{{ asset('image/UniLogo.png') }}" alt="University Logo" class="logo" />
        </div>

        <!-- Styled h2 heading -->
        <h2>Welcome to Student Appointment System <br> by University Of Pangasinan</h2>

        <!-- Custom content container -->
        <div class="custom-container">
            <!-- Content Slot -->
            {{ $slot }}
        </div>
    </div>
</body>
</html>
