<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Student Appointment</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa; 
            color: #343a40; 
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column; 
            height: 100vh; 
            overflow: hidden; /* Prevent any scrolling */
            position: relative; 
        }
        header {
            display: flex;
            justify-content: space-between; /* Space between logo and buttons */
            align-items: center; /* Align items vertically */
            padding: 5px;
            background-color: white;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        }
        .btn {
            background-color: #347928; 
            color: white; 
            padding: 6px 12px; /* Adjusted padding for smaller size */
            margin-left: 10px; 
            text-decoration: none; 
            border-radius: 5px;
            display: inline-block; 
            font-size: 14px; /* Adjusted font size */
            transition: background-color 0.3s; 
        }
        .btn:hover {
            background-color: #FEC260; 
        }
        .container {
            flex: 1; 
            display: flex;
            flex-direction: column; 
            align-items: flex-start; 
            justify-content: center; 
            text-align: left; 
            margin-left: 160px; 
            padding: 20px; 
        }
        .title {
            font-size: 36px; 
            margin-bottom: 10px;
            opacity: 0;
            animation: fadeInMove 2s forwards;
        }
        .note {
            font-size: 18px;
            margin-top: 10px; 
            line-height: 1.5; 
            max-width: 600px; 
            opacity: 0;
            animation: fadeInMove 2s forwards 0.5s;
        }
        .logo {
            position: absolute; 
            right: 20px; 
            top: 55%; 
            transform: translateY(-50%); 
            opacity: 0.7; 
            width: 40vw; 
            height: 640px; 
            margin-right: -20px;
            z-index: -1;
        }
        .small-logo {
            width: 80px; 
            height: auto;
            margin-left: 150px;
        }
        .button-container {
            margin-right: 40px;
            display: flex; /* Arrange buttons horizontally */
            gap: 10px; /* Space between buttons */
        }
        footer {
            background-color: #347928;
            color: white;
            text-align: center;
            padding: 8px;
            position: relative;
            bottom: 0;
            width: 100%;
            font-size: 9px;
        }

        @keyframes fadeInMove {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="antialiased">
    <header>
        <img src="{{ asset('image/UniLogo.png') }}" alt="Small Logo" class="small-logo"> <!-- Logo aligned to the left -->
        <div class="button-container"> <!-- Buttons aligned to the right -->
            @if (Route::has('login'))
                @auth
                   
                @else
                    <a href="{{ route('login') }}" class="btn">Log in</a>
                @endauth
                <a href="{{ route('register') }}" class="btn">Register</a>
            @endif
        </div>
    </header>
    
    <div class="container">
        <div class="title">Welcome to University of Pangasinan<br>"Making Lives Better Through Education"<br> Student Appointment System</div>
        <div class="note">Empowering Students, One Appointment at a Time! Streamline your journey at the University of Pangasinan with our easy-to-use appointment system.
        Connect, collaborate, and conquer your academic goals effortlessly!</div>
        <img src="{{ asset('image/OIP.jpg') }}" alt="University Logo" class="logo">
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} University of Pangasinan. All rights reserved.</p>
        <p>Contact us: phinmaed@gmail.com</p>
    </footer>
</body>
</html>
