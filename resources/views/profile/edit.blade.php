<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Student Appointment</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('image/UpangFav.ico') }}">

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
            overflow: scroll;
        }
        header {
            
            display: flex;
            justify-content: space-between; 
            align-items: center; 
            padding: 5px;
            background-color: #D8D9DA;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        }
        .btn {
            background-color: #185519;
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
            background-color: #D8D9DA;
            color: black; 
            border: none; 
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
            background-color: #185519;
            color: white;
            text-align: center;
            padding: 8px;
            position: relative;
            bottom: 0;
            width: 100%;
            font-size: 9px;
        }
        /* General styling */
.profile-container {
    max-width: 900px;
    margin: auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
    margin-bottom: 20px;
}

/* Heading styling */
.profile-container h3 {
    font-size: 1.5em;
    color: #333;
    margin-top: 20px;
    margin-bottom: 10px;
    border-bottom: 2px solid #e0e0e0;
    padding-bottom: 5px;
}

/* Paragraph styling */
.profile-container p {
    color: #666;
    font-size: 1em;
    margin-bottom: 20px;
}

/* Button styling */
button {
    background-color: #28a745;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 1em;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #218838;
}

/* Delete button styling */
.delete-button {
    background-color: #dc3545;
}

.delete-button:hover {
    background-color: #c82333;
}

/* Form styling */
form {
    margin-bottom: 20px;
}

input[type="text"], input[type="password"], input[type="email"] {
    width: 100%;
    padding: 10px;
    margin: 8px 0 12px 0;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 5px;
    transition: border-color 0.3s;
}

input[type="text"]:focus, input[type="password"]:focus, input[type="email"]:focus {
    border-color: #28a745;
    outline: none;
}

    </style>
</head>
<body class="antialiased">
    <header>
    <a href="/home">
                <img src="{{ asset('image/UniLogo.png') }}" alt="Small Logo" class="small-logo">
            </a>
        <div class="button-container">
            @if (Route::has('login'))
                @auth
                    <div class="dropdown">
                        <button class="dropbtn">Hi, {{ Auth::user()->name }}! <i class="fas fa-chevron-down"></i></button>
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
    <div class="profile-container">
    <h3>{{ __('Update Profile Information') }}</h3>
    @include('profile.partials.update-profile-information-form')

    <h3>{{ __('Change Password') }}</h3>
    @include('profile.partials.update-password-form')

    <h3>{{ __('Delete Account') }}</h3>
    <p>
        {{ __('Once you delete your account, all of its resources and data will be permanently deleted. Please proceed with caution.') }}
    </p>
    <form>
        <!-- other fields for the delete form -->
        <button class="delete-button" type="submit">{{ __('Delete Account') }}</button>
    </form>
</div>

    <footer>
        <p>&copy; {{ date('Y') }} University of Pangasinan. All rights reserved.</p>
        <p>Contact us: phinmaed@gmail.com</p>
    </footer>
</body>
</html>
