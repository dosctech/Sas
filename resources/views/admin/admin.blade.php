<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('image/UpangFav.ico') }}">

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
            background-color: #185519;
            color: white;
            padding: 15px 30px;
            position: relative;
            z-index: 1000;
            height: 80px; /* Ensure there's enough height for the navbar */
        }

        .navbar h1 {
            margin: 0;
            font-size: 50px; /* Increased font size */
            text-align: center; /* Center the text */
            margin-left: 450px;
            flex: 1; /* Allow the title to take available space */
        }

        .navbar a {
            color: black;
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
            background-color: #185519;
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
            color:#ddd;
            text-decoration: none;
            padding: 10px;
            margin: 20px 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: black;
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

        /* Dashboard Styling */
    .dashboard {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        padding: 20px;
        background-color: #f9f9f9;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
        align-items: center;
    }

    .dashboard-item {
        flex: 1;
        text-align: center;
        padding: 10px;
        background-color: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        margin: 0 10px;
    }

    .dashboard-item h3 {
        font-size: 18px;
        font-weight: bold;
        color: #2d3748;
        margin-bottom: 10px;
    }

    .dashboard-item p {
        font-size: 20px;
        color: #333;
    }

    /* Align the card section to be consistent with dashboard */
    .card {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        padding: 20px;
        background-color: #f9f9f9;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
    }

    .card-column {
        flex: 1;
        padding: 10px;
        background-color: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
    }

    /* Responsive design for smaller screens */
    @media (max-width: 768px) {
        .dashboard {
            flex-direction: column;
        }

        .dashboard-item {
            margin-bottom: 20px;
        }

        .card {
            flex-direction: column;
        }

        .card-column {
            margin-bottom: 20px;
        }
    }

        .card {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        padding: 20px;
        background-color: #f9f9f9;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
    }

    .card-column {
        flex: 1;
        padding: 10px;
        background-color: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
    }

    .card-title {
        font-size: 18px;
        font-weight: bold;
        color: #2d3748;
        margin-bottom: 10px;
        text-align: center;
        border-bottom: 2px solid #28a745;
        padding-bottom: 10px;
    }

    .card-column ul {
        list-style-type: none;
        padding: 0;
    }

    .card-column li {
        padding: 5px 0;
        font-size: 16px;
        color: #333;
    }

    /* Status Colors */
    .status-pending {
        color: #000; /* Black for pending */
    }

    .status-accepted {
        color: #28a745; /* Green for accepted */
    }

    .status-rejected {
        color: #ff4d4d; /* Red for rejected */
    }

    /* Responsive design for smaller screens */
    @media (max-width: 768px) {
        .card {
            flex-direction: column;
        }

        .card-column {
            margin-bottom: 20px;
        }
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
            margin-right: 30px;
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
            right: 0; /* Align dropdown to the right */
        }

        .dropdown-content {
            display: flex; /* Use flexbox for horizontal alignment */
            flex-direction: column; /* Stack items vertically */
            gap: 5px; /* Space between items */
        }

        .dropdown-content p {
            color: #000;
            margin: 0;
            cursor: pointer;
            padding: 5px 0; /* Adds some padding for a better clickable area */
        }

        .dropdown-content p:hover {
            background-color: #f1f1f1; /* Highlight effect on hover */
        }
        .pagination-wrapper .pagination {
            display: inline-block;
            list-style-type: none;
            padding: 0;
        }

        .pagination-wrapper .pagination li {
            display: inline;
            margin: 0 5px;
        }

        .pagination-wrapper .pagination li a {
            color: #3490dc;
            padding: 5px 10px;
            text-decoration: none;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .pagination-wrapper .pagination li.active span {
            background-color: #3490dc;
            color: white;
            border-color: #3490dc;
        }
        .search-bar {
            display: flex;
            justify-content: flex-end; /* Aligns the search bar to the right */
            align-items: center;
            margin: 10px 0;
            color: #000;
        }

        .search-bar input {
            width: 270px;
            padding: 5px 15px;
            border: 2px solid #ccc;
            border-radius: 25px;
            font-size: 16px;
            transition: border-color 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-right: 15px;
            color: #000;
            opacity: 0.9;
        }

        .search-barinput:focus {
            border-color: #185519;
            outline: none;
            box-shadow: 0 2px 5px rgba(24, 85, 25, 0.4); /* Green shadow when focused */
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .search-bar input {
                width: 100%;
            }
        }
        .small-logo{
            margin-top: 50px;
        }
        
    </style>
    <script>
    // Ensure the sidebar starts open when the page loads
    window.onload = function() {
        const sidebar = document.querySelector('.sidebar');
        const content = document.querySelector('.content');
        const toggleBtn = document.querySelector('.toggle-btn');
        
        // Add the 'open' and 'expanded' classes when the page loads
        sidebar.classList.add('open');
        content.classList.add('expanded');
        toggleBtn.classList.add('open');
        toggleBtn.setAttribute('aria-label', 'Close sidebar');
    };

    function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        const content = document.querySelector('.content');
        const toggleBtn = document.querySelector('.toggle-btn');
        
        // Toggle the sidebar state
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

        <form action="{{ route('home') }}" method="GET" class="search-bar" style="display: flex; align-items: center;">
            <input type="text" name="search" placeholder="Search by name..."  id="searchInput">
        </form>
        <div class="notification" onclick="toggleDropdown()">
            <span class="notification-icon">&#128276;</span>
            <span class="notification-badge" id="notificationBadge"></span>
            <div class="dropdown" id="notificationDropdown">
                <div class="dropdown-content">
                    @foreach($formData as $request)
                        @if($request->recentRequest)
                            <!-- Do nothing if there's a recent request flag -->
                        @else
                            <p onclick="handleDropdownClick('Student: {{ $request->last_name }},  Student Number: {{ $request->student_number }}')">
                                @if($request->status == 'Accepted')
                                    🎉 <b>Accepted Request - <br> Requesting For {{ $request->document_type}}</b> <br> 
                                    <b>I'm a {{ $request->user_type}} - {{ $request->last_name }}, {{ $request->first_name }} {{ $request->middle_name }} ({{ $request->student_number }})</b> -
                                    <br>This request has been accepted <br> <b>Status: {{ $request->status }}</b>
                                @elseif($request->status == 'Rejected')
                                    ❌ <b>Rejected Request - <br> Requesting For {{ $request->document_type}}</b> <br> 
                                    <b>I'm a {{ $request->user_type}} - {{ $request->last_name }}, {{ $request->first_name }} {{ $request->middle_name }} ({{ $request->student_number }})</b> -
                                    <br>This request has been rejected. Please contact the Registrar for further assistance. <br> <b>Status: {{ $request->status }}</b>
                                @else
                                    🕒 <b>New Request - <br> Requesting For {{ $request->document_type}}</b> <br> 
                                    <b>I'm a {{ $request->user_type}} - {{ $request->last_name }}, {{ $request->first_name }} {{ $request->middle_name }} ({{ $request->student_number }})</b> -
                                    <br>This Request is still pending <br> <b>Status: {{ $request->status }}</b>
                                @endif
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
    <img src="{{ asset('image/UniLogoAdmin.png') }}" alt="Small Logo" class="small-logo">

        <a href="{{route ('home')}}">Dashboard</a>
        <!-- Use route helper for the admin requests page -->
        <a href="{{ route('admin.adminreq') }}">Student Requests</a>
        <a href="{{ route('admin.acceptedreq') }}">Accepted Requests</a>
        <a href="{{ route('admin.rejectedreq') }}">Rejected Requests</a>
    </div>


    <div class="content">
    
        <div class="dashboard">
            <div class="dashboard-item">
                <h3>Total Requests</h3>
                <p>{{ $totalRequests }}</p>
            </div>
            <div class="dashboard-item">
                <h3>Accepted</h3>
                <p>{{ $acceptedRequestsCount }}</p>
            </div>
            <div class="dashboard-item">
                <h3>Rejected</h3>
                <p>{{ $rejectedRequestsCount }}</p>
            </div>
    </div>

        <!-- Student Requests Section -->
        <div class="card">
                <div class="card-column">
                    <div class="card-title">Recent Requests</div>
                    <ul>
                        @foreach ($paginatedRecentRequests as $request)
                            @if ($request->status === 'Pending')
                                <li>{{ $request->last_name }}, {{ $request->first_name }} -{{ $request->user_type}}- {{ $request->middle_name }} - 
                                    <b class="status-pending">{{ $request->status }}</b>
                                </li>
                            @endif
                        @endforeach
                    </ul>   
                    <div class="pagination-wrapper"> 
                    {{ $paginatedRecentRequests->appends(['rejected_page' => request()->get('rejected_page'), 'accepted_page' => request()->get('accepted_page')])->links() }}
                    </div>
                </div>
                <div class="card-column">
                    <div class="card-title">Accepted Requests</div>
                    <ul>
                        @foreach ( $paginatedAcceptedRequests as $request)
                            @if ($request->status === 'Accepted')
                                <li>{{ $request->last_name }}, {{ $request->first_name }} -{{ $request->user_type}}- {{ $request->middle_name }} - 
                                    <b class="status-accepted">{{ $request->status }}</b>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <div class="pagination-wrapper"> 
                    {{ $paginatedAcceptedRequests->appends(['rejected_page' => request()->get('rejected_page'), 'recent_page' => request()->get('recent_page')])->links() }}
                    </div>
                </div>

                <div class="card-column">
                    <div class="card-title">Rejected Requests</div>
                    <ul>
                        @foreach ($paginatedRejectedRequests as $request)
                            @if ($request->status === 'Rejected')
                                <li>{{ $request->last_name }}, {{ $request->first_name }} -{{ $request->user_type}}- {{ $request->middle_name }} - 
                                    <b class="status-rejected">{{ $request->status }}</b>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <div class="pagination-wrapper"> 
                    {{ $paginatedRejectedRequests->appends(['accepted_page' => request()->get('accepted_page'), 'recent_page' => request()->get('recent_page')])->links() }}
                    </div>
                </div>
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
