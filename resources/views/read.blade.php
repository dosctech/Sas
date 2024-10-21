<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submitted Request Data</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('image/UpangFav.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
       body {
    display: flex;
    flex-direction: column; /* Set flex direction to column */
    min-height: 100vh; /* Ensure body takes at least full viewport height */
    font-family: 'Nunito', sans-serif;
    background-color: #eef2f3;
    color: #2d2d2d;
    margin: 0;
    padding: 0;
}
        header {
            display: flex;
            justify-content: space-between; 
            align-items: center; 
            padding: 5px;
            background-color: #D8D9DA;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin: 0;
            font-size: 2.5em;
        }

        .container {
    flex-grow: 1; /* Allow container to grow and fill available space */
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

        .alert {
            background-color: #d1e7dd;
            color: #0f5132;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #b3e0b3;
        }

        .card {
            border: none;
            margin-top: 20px;
            
        }

        .card-title {
            font-size: 1.75em;
            font-weight: 500;
            color: #333;
            margin-bottom: 15px;
            border-bottom: 2px solid #347928;
            padding-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 0.9em;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #347928;
            color: white;
        }

        td {
            background-color: #f8f9fa;
        }

        .notification-container {
            position: relative;
            margin-bottom: 20px;
        }

        .notification {
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 24px;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -10px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
        }

        .dropdown {
            display: none;
            position: absolute;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            min-width: 300px;
            max-height: 300px;
            overflow-y: auto;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            z-index: 1;
            padding: 10px;
            margin-left: -320px;
        }

        .dropdown-content {
            display: flex;
            flex-direction: column;
            gap: 5px;
            font-size: 15px;
        }

        .dropdown-content p {
            margin: 0;
            cursor: pointer;
            padding: 5px 10px;
            border: 1px solid #347928;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .dropdown-content p:hover {
            background-color: #e7f1ff;
        }

        .btn {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-weight: 500;
            border: none;
        }

        .btn:hover {
            background-color: #218838;
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
        .small-logo {
            width: 80px;
            height: auto;
            margin-left: 155px;
        }
        .button-container {
            margin-right: 10px;
        }
        .container {
            padding: 20px;
            color: #181C14;
            border: 4px solid #ddd;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            margin: 20px auto;
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
        footer {
    background-color: #185519;
    color: white;
    text-align: center;
    padding: 8px;
    width: 100%;
    font-size: 9px;
}
    </style>
    <script>
        // Function to toggle the dropdown visibility
        function toggleDropdown() {
            const dropdown = document.getElementById('notificationDropdown');
            const badge = document.getElementById('notificationBadge');

            // Clear the notification badge
            badge.style.display = 'none';

            // Toggle the dropdown visibility
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }

        // Close the dropdown if clicked outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.notification')) {
                const dropdowns = document.getElementsByClassName("dropdown");
                for (let i = 0; i < dropdowns.length; i++) {
                    const openDropdown = dropdowns[i];
                    if (openDropdown.style.display === 'block') {
                        openDropdown.style.display = 'none';
                    }
                }

                // Show the notification badge when dropdown is closed
                document.getElementById('notificationBadge').style.display = 'block';
            }
        }

        // Function to handle click on dropdown items
        function handleDropdownClick(message) {
            alert(message); // You can change this to any action you want to perform
        }
    </script>
</head>
<body>
    <header>
    <a href="/home">
                <img src="{{ asset('image/UniLogo.png') }}" alt="Small Logo" class="small-logo">
            </a>
            <div class="button-container">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/read') }}" class="btn">Request Details</a>
                        <a href="{{ route('request') }}" class="btn">Request</a>
                    @endauth
                @endif
            </div>
        </header>
    <div class="notification-container">
        <div class="notification" onclick="toggleDropdown()">
            📩
            <span class="notification-badge" id="notificationBadge">{{ $acceptedCount + $rejectedCount }}</span>
            <div class="dropdown" id="notificationDropdown">
                <div class="dropdown-content">
                    @foreach($formData as $request)
                        @if($request->status === 'Accepted')
                            <p onclick="handleDropdownClick('Student: {{ $request->first_name }} {{ $request->middle_name }} {{ $request->last_name }}, Number: {{ $request->student_number }} - Your request is now accepted. ✔️')">
                                ✔️ {{ $request->first_name }} {{ $request->middle_name }} {{ $request->last_name }} ({{ $request->student_number }}) - Your request is now accepted.
                                <br>See you at Registrar University of Pangasinan.
                            </p>
                        @elseif($request->status === 'Rejected')
                            <p onclick="handleDropdownClick('Student: {{ $request->first_name }} {{ $request->middle_name }} {{ $request->last_name }}, Number: {{ $request->student_number }} - Your request is now rejected. ❌')">
                                ❌ {{ $request->first_name }} {{ $request->middle_name }} {{ $request->last_name }} ({{ $request->student_number }}) - Your request is now rejected.
                                <br>Just try another request, maybe you typed incorrect information. 
                            </p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h1 class="mb-4">Submitted Request Data</h1>

        @if(session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        @if($formData->count())
            <div class="card">
                <div class="card-title">Request Details</div>
                <table>
                    <tr>
                        <th>User Type</th>
                        <th>Document Type</th>
                        <th>Dry Seal</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Student Number</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Status</th>
                    </tr>
                    @foreach($formData as $request)
                    <tr>
                        <td>{{ $request->user_type }}</td>
                        <td>{{ $request->document_type }}</td>
                        <td>{{ $request->dry_seal }}</td>
                        <td>{{ $request->last_name }}</td>
                        <td>{{ $request->first_name }}</td>
                        <td>{{ $request->middle_name }}</td>
                        <td>{{ $request->student_number }}</td>
                        <td>{{ $request->email }}</td>
                        <td>{{ $request->contact }}</td>
                        <td>{{ $request->status ?? 'Pending' }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        @else
            <div class="alert">
                No requests submitted yet.
            </div>
        @endif
    </div>
    <footer>
        <p>&copy; {{ date('Y') }} University of Pangasinan. All rights reserved.</p>
        <p>Contact us: phinmaed@gmail.com</p>
    </footer>
</body>
</html>
