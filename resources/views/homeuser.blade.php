<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Student Appointment</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
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
            overflow: hidden; 
            position: relative; 
        }
        header {
            display: flex;
            justify-content: space-between; 
            align-items: center; 
            padding: 5px;
            background-color: white;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        }
        .btn {
            background-color: #347928; 
            color: white; 
            padding: 6px 12px; 
            margin-left: 10px; 
            text-decoration: none; 
            border-radius: 5px;
            display: inline-block; 
            font-size: 14px; 
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
        }
        .note {
            font-size: 18px;
            margin-top: 10px; 
            line-height: 1.5; 
            max-width: 600px; 
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
            display: flex; 
            gap: 10px; 
        }
        .dropdown {
            position: relative; 
            display: inline-block;
        }

        .dropbtn {
            padding: 8px 12px;  
            background-color: white; 
            color: black; 
            border: 2px solid #347928; 
            border-radius: 5px; 
            cursor: pointer; 
            transition: background-color 0.3s; 
        }

        .dropbtn:hover {
            background-color: #FEC260; 
        }

        .dropdown-content {
            display: none; 
            position: absolute; 
            background-color: white; 
            min-width: 160px; 
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); 
            z-index: 1; 
        }

        .dropdown:hover .dropdown-content {
            display: block; 
        }

        .dropdown-content a {
            color: black; 
            padding: 12px 16px; 
            text-decoration: none; 
            display: block; 
            transition: background-color 0.3s; 
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1; 
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
    </style>
</head>
<body class="antialiased">
    <header>
        <img src="{{ asset('image/UniLogo.png') }}" alt="Small Logo" class="small-logo">
        <div class="button-container">
            @if (Route::has('login'))
                @auth
                    <a href="{{ route('request') }}" class="btn">Request</a>
                    
                    <div class="dropdown">
                        <button class="dropbtn">{{ Auth::user()->name }} <i class="fas fa-chevron-down"></i></button>
                        <div class="dropdown-content">
                            <a href="{{ url('/profile') }}">Profile</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </div>
                    </div>
                @endauth
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
