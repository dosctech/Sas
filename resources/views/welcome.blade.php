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
            position: relative; 
        }
        header {
            display: flex;
            justify-content: space-between; /* Space between items in header */
            align-items: center; /* Center items vertically */
            padding: 20px; 
            background-color: white; 
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
        }
        .btn {
            background-color: #347928; 
            color: white; 
            padding: 10px 20px; 
            margin: 0 10px; 
            text-decoration: none; 
            border-radius: 5px;
            display: inline-block; 
            transition: background-color 0.3s; 
        }
        .btn:hover {
            background-color: #FEC260; 
        }
        .container {
            flex: 1; 
            display: flex;
            flex-direction: column; /* Change to column to stack elements */
            align-items: flex-start; 
            justify-content: center; /* Center vertically */
            text-align: left; 
            position: relative; 
            margin-left: 180px; /* Adjust as needed */
            padding: 20px; /* Added padding for better spacing */
        }
        .title {
            font-size: 36px; 
            margin-bottom: 10px; /* Reduced margin for closer spacing */
        }
        .note {
            font-size: 18px; /* Adjusted size for the note */
            margin-top: 10px; /* Space above the note */
            line-height: 1.5; /* Improved readability */
            max-width: 600px; /* Set max width for the note */
        }
        .logo {
            position: absolute; 
            right: 20px; 
            top: 50%; 
            transform: translateY(-50%); 
            opacity: 0.7; 
            width: 40vw; 
            height: auto; 
            margin-right: 80px;
        }
        .small-logo {
            width: 50px; /* Set size for small logo */
            height: auto; /* Maintain aspect ratio */
            margin-left: 155px; /* Space between small logo and buttons */
        }
        .button-container {
            margin-right: 160px; /* Push buttons to the right */
        }
    </style>
</head>
<body class="antialiased">
    <header>
        <img src="{{ asset('image/UniLogo.png') }}" alt="Small Logo" class="small-logo"> <!-- Add small logo -->
        <div class="button-container"> <!-- New class for buttons -->
            <a href="{{ route('request') }}" class="btn">Request</a>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn">Log in</a>
                @endauth
            @endif
        </div>
    </header>
    
    <div class="container">
        <div class="title">Welcome to University of Pangasinan<br>"Making Lives Better Through Education"<br> Student Appointment System</div>
        <div class="note">Empowering Students, One Appointment at a Time! Streamline your journey at the University of Pangasinan with our easy-to-use appointment system. <br>
        Connect, collaborate, and conquer your academic goals effortlessly!<br> Note: The login Button is for Admin Only, Proceed to "Request"</div>
        <img src="{{ asset('image/UniLogo.png') }}" alt="University Logo" class="logo"> <!-- Use asset() function -->
    </div>
</body>
</html>
