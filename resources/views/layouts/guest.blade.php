<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('image/UpangFav.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Container for the full page layout */
        .page-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            min-height: 100vh; /* Full viewport height */
            padding: 20px;
            background-color: #f0f4f8; /* Light background */
        }

        /* Left section for the logo */
        .left-section {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Logo styling */
        .logo {
            width: 650px; /* Adjust the size of the logo */
            height: auto;
        }

        /* Right section for welcome text and login box */
        .right-section {
            flex: 1;
            max-width: 500px;
            margin-right: 150px; /* Limit the width of the right section */
        }

        /* Text styling above the login box */
        .welcome-text {
            font-size: 24px;
            font-weight: 600;
            color: #2d3748; /* Dark gray */
            text-align: center;
            margin-bottom: 20px;
        }

        /* Custom styling for the login box */
        .custom-container {
            width: 100%;
            padding: 25px;
            background-color: #f9f9f9;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            border: 1px solid #28a745; /* Green border */
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        /* Hover effect for login box */
        .custom-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        /* Responsive design for smaller screens */
        @media (max-width: 768px) {
            .page-container {
                flex-direction: column;
                text-align: center;
            }

            .left-section {
                margin-bottom: 20px;
            }

            .right-section {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="page-container">
        <!-- Left section with logo -->
        <div class="left-section">
            <img src="{{ asset('image/UniLogo.png') }}" alt="University Logo" class="logo" />
        </div>

        <!-- Right section with welcome text and login box -->
        <div class="right-section">
            <!-- Welcome text -->
            <div class="welcome-text">
                Welcome to Student Appointment System <br> by University Of Pangasinan
            </div>

            <!-- Login box -->
            <div class="custom-container">
                <!-- Content Slot for login form -->
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>
