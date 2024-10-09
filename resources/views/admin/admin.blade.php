<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-size: cover;
            background-position: center;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            overflow: hidden;
            flex-direction: column;
        }

        .navbar {
            display: flex;
            justify-content: center; /* Center the content */
            align-items: center;
            background-color: green;
            color: white;
            padding: 15px 30px;
            position: relative;
            z-index: 1000;
            height: 80px; /* Ensure there's enough height for the navbar */
        }

        .navbar h1 {
            margin: 0;
            font-size: 56px; /* Increased font size */
            text-align: center; /* Center the text */
            margin-left: 150px;
            flex: 1; /* Allow the title to take available space */
        }


        .navbar a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .navbar a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: rgba(255, 255, 255, 0.9);
            position: fixed;
            left: -250px;
            transition: left 0.3s ease;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            padding: 30px;
        }

        .sidebar.open {
            left: 0;
        }

        .sidebar h3 {
            color: #333;
            margin-top: 50px;
        }

        .sidebar a {
            display: block;
            color: #000;
            text-decoration: none;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #efefef;
        }

        .toggle-btn {
            position: fixed;
            left: 20px;
            top: 20px;
            background-color: white;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            z-index: 1001;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            height: 35px;
            width: 35px;
            transition: transform 0.5s ease;
        }

        .toggle-btn span {
            background-color: black;
            height: 3px;
            width: 100%;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .toggle-btn.open span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .toggle-btn.open span:nth-child(2) {
            opacity: 0;
        }

        .toggle-btn.open span:nth-child(3) {
            transform: rotate(-45deg) translate(6px, -6px);
        }

        .content {
            margin-left: 20px;
            padding: 20px;
            flex-grow: 1;
            transition: margin-left 0.3s ease;
            height: calc(100vh - 80px); /* Adjust for navbar height */
            overflow-y: auto;
        }

        .content.expanded {
            margin-left: 250px;
        }

        .dashboard {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .dashboard div {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .dashboard div h3 {
            margin: 0;
            font-size: 1.2em;
            color: #333;
        }

        .dashboard div p {
            margin: 0;
            font-size: 1.5em;
            font-weight: bold;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }

        .card-title {
            font-size: 1.5em;
            font-weight: 500;
            color: black;
            margin-bottom: 15px;
            border-bottom: 2px solid green;
            padding-bottom: 10px;
        }

        .content h1 {
            text-align: center;
            color: green;
            margin-bottom: 20px;
            font-size: 4em;
            font-weight: 700;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .toggle-btn {
                left: 10px;
                top: 10px;
            }

            .content {
                margin-left: 0;
                padding-left: 10px;
            }
        }
        .notification {
            position: relative;
            display: inline-block;
            margin-left: auto;
            margin-right: 40px;
            cursor: pointer; /* Make it clear that the icon is clickable */
        }

        .notification-icon {
            font-size: 24px;
        }

        .notification-badge {
            position: absolute;
            top: 10px;
            right: -10px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
        }

        .dropdown {
            margin-left:-350px;
            display: none;
            position: absolute;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            min-width: 300px; /* Increased minimum width for horizontal expansion */
            max-height: 300px; /* Set a maximum height */
            overflow-y: auto; /* Enable scrolling if the content is too long */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            z-index: 1;
            padding: 10px; /* Added padding for better spacing */
        }

        .dropdown-content {
            display: flex; /* Use flexbox for horizontal alignment */
            flex-direction: column; /* Stack items vertically */
            gap: 5px; /* Space between items */
        }

        .dropdown-content p {
            color:#000;
            margin: 0;
            cursor: pointer;
            padding: 5px 0; /* Adds some padding for a better clickable area */
        }

        .dropdown-content p:hover {
            background-color: #f1f1f1; /* Highlight effect on hover */
        }
    </style>
    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const content = document.querySelector('.content');
            const toggleBtn = document.querySelector('.toggle-btn');
            sidebar.classList.toggle('open');
            content.classList.toggle('expanded');
            toggleBtn.classList.toggle('open');

            if (sidebar.classList.contains('open')) {
                toggleBtn.setAttribute('aria-label', 'Close sidebar');
            } else {
                toggleBtn.setAttribute('aria-label', 'Open sidebar');
            }
        }
    </script>
</head>

<body>
    <button class="toggle-btn" aria-label="Open sidebar" onclick="toggleSidebar()">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <div class="navbar">
        <h1>Admin Dashboard</h1>
        
        <div class="notification" onclick="toggleDropdown()">
            <span class="notification-icon">&#128276;</span>
            <span class="notification-badge" id="notificationBadge"></span>
            <div class="dropdown" id="notificationDropdown">
                <div class="dropdown-content">
                    @foreach($formData as $request)
                    @if($request->recentRequest)
                        @else
                            <p onclick="handleDropdownClick('Student: {{ $request->name }}, Number: {{ $request->student_number }} - 🕒New Request.')">
                            🕒 <b>New Request</b> <br> <b>{{ $request->user_type}} - {{ $request->name }} ({{ $request->student_number }})</b> -
                            <br>Please visit the Registrar at the University of Pangasinan for further information. <br> <b>{{ $request->status }}</b>
                            </p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div>
            <x-app-layout></x-app-layout> <!-- Optional, adjust as needed -->
        </div>
    </div>

    <div class="sidebar">
    <a href="{{route ('home')}}">Dashboard</a>
        <!-- Use route helper for the admin requests page -->
        <a href="{{ route('admin.adminreq') }}">Student Requests</a>
        
    </div>


    <div class="content">
        <div class="dashboard">
            <div>
                <h3>Total Requests</h3>
                <p>{{ $totalRequests }}</p>
            </div>
            <div>
                <h3>Accepted</h3>
                <p>{{ $acceptedRequests }}</p>
            </div>
            <div>
                <h3>Rejected</h3>
                <p>{{ $rejectedRequests }}</p>
            </div>
        </div>

        <!-- Student Requests Section -->
        <div class="card">
                <div class="card-title">Recent Requests</div>
                <ul>
                    @foreach ($recentRequests as $request)
                        @if ($request->status === 'pending') <!-- Assuming 'Pending' is the status for recent requests -->
                            <li>{{ $request->name }} - {{ $request->status }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <div class="card" id="accepted">
                <div class="card-title">Accepted Requests</div>
                <ul>
                    @foreach ($recentRequests as $request)
                        @if ($request->status === 'Accepted') <!-- Filter accepted requests -->
                            <li>{{ $request->name }} - {{ $request->status }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <div class="card" id="rejected">
                <div class="card-title">Rejected Requests</div>
                <ul>
                    @foreach ($recentRequests as $request)
                        @if ($request->status === 'Rejected') <!-- Filter rejected requests -->
                            <li>{{ $request->name }} - {{ $request->status }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>


    </div>
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
            if (!event.target.matches('.notification-icon')) {
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
</body>

</html>
