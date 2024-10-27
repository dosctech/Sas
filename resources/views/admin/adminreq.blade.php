<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submitted Request Data</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('image/UpangFav.ico') }}">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        /* Add your existing styles here */
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
            overflow-y: auto;
            
        }

        .navbar {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #185519;
            color: white;
            padding: 15px 30px;
            position: relative;
            z-index: 1000;
            height: 80px;
        }

        .navbar h1 {
            margin: 0;
            font-size: 56px;    
            text-align: center;
            margin-left: 150px;
            flex: 1;
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
            background-color: grey;
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
            margin-right: 20px;
            padding: 20px;
            flex-grow: 1;
            transition: margin-left 0.3s ease;
            overflow-y: auto;
            
        }

        .content.expanded {
            margin-left: 250px;
        }
        

        .card {
            
            background-color: #ffffff; 
            border-radius: 10px; 
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); 
            margin: 20px; 
            padding: 20px; 
            width: 100%;
            transition: transform 0.2s; 
        }
        
        .dashboard {
            display: grid;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .content h1 {
            text-align: center;
            color: green;
            margin-bottom: 20px;
            font-size: 4em;
            font-weight: 700;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            
            
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
            
            
        }

        th {
            background-color: #E4E0E1;
            color: black;
            text-transform: uppercase;
            font-weight: bold;
        }

        td {
            color: #333;
            
        }

        .btn {
            display: inline-block;
            padding: 5px 5px;
            background-color: #ff9800;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-weight: 500;
        }

        .btn:hover {
            background-color: #e68a00;
        }

        .btn-accept {
            background-color: #28a745;
        }

        .btn-accept:hover {
            background-color: #218838;
        }

        .btn-reject {
            background-color: #dc3545;
        }
        .btn-delete {
            background-color: grey;
        }

        .btn-reject:hover {
            background-color: #c82333;
        }
        .btn-export {
            background-color: white; /* Green background */
            color: black; /* White text */
            padding: 10px 20px; /* Padding for spacing */
            font-size: 16px; /* Font size */
            border: none; /* Remove border */
            border-radius: 5px; /* Rounded corners */
            text-decoration: none; /* Remove underline */
            display: inline-block; /* Display inline for a button-like effect */
            cursor: pointer; /* Change cursor on hover */
            transition: background-color 0.3s ease; /* Smooth hover effect */
        }

        .btn-export:hover {
            background-color: #45a049; /* Darker green on hover */
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
        .card-header {
            display: flex;
            justify-content: space-between; /* Positions title and search input on opposite sides */
            align-items: center; /* Vertically center the items */
            padding: 10px; /* Adjust padding as needed */
        }

        .card-title {
            font-size: 2em; /* Larger font size for title */
            font-weight: bold; /* Bold text */
            color: #333; /* Darker text color */
            margin: 0; /* Remove default margin */
            border-bottom: 5px solid green; /* Blue underline */
            padding-bottom: 5px; /* Space below the border */
        }

        /* Update the search form for the new layout */
        .search-form {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 10px 0;
        }

        .search-form input {
            width: 200px;
            padding: 5px 15px;
            border: 2px solid #ccc;
            border-radius: 25px;
            font-size: 16px;
            transition: border-color 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-right: 15px;
            color: #000;
        }

        .search-form input:focus {
            border-color: #185519;
            outline: none;
            box-shadow: 0 2px 5px rgba(24, 85, 25, 0.4); /* Green shadow when focused */
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .search-form input {
                width: 100%;
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
        .search-form1 {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 10px 0;
        }

        .search-form1 input {
            width: 200px;
            padding: 5px 15px;
            border: 2px solid #ccc;
            border-radius: 25px;
            font-size: 16px;
            transition: border-color 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-right: 15px;
            color: #000;
        }

        .search-form1 input:focus {
            border-color: #185519;
            outline: none;
            box-shadow: 0 2px 5px rgba(24, 85, 25, 0.4); /* Green shadow when focused */
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
    <h1 class="mb-4">Admin Dashboard</h1>

    <div class="notification" onclick="toggleDropdown()">
            <span class="notification-icon">&#128276;</span>
            <span class="notification-badge" id="notificationBadge"></span>
            <div class="dropdown" id="notificationDropdown">
                <div class="dropdown-content">
                    @foreach($formData as $request)
                    @if($request->recentRequest)
                        @else
                            <p onclick="handleDropdownClick('Student: {{ $request->name }}, Number: {{ $request->student_number }} - 🕒New Request.')">
                            🕒 <b>New Request - <br> Requesting For {{ $request->document_type}}</b> <br> <b>I'm a {{ $request->user_type}} - {{ $request->last_name }}, {{ $request->first_name }} {{ $request->middle_name }} ({{ $request->student_number }})</b> -
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
    <img src="{{ asset('image/UniLogoAdmin.png') }}" alt="Small Logo" class="small-logo">

        <a href="{{route ('home')}}">Dashboard</a>
        <a href="{{ route('admin.adminreq') }}">Student Requests</a>
        <a href="{{ route('admin.acceptedreq') }}">Accepted Requests</a>
        <a href="{{ route('admin.rejectedreq') }}">Rejected Requests</a>
    </div>

    <div class="content">
        <div class="container">

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if($formData->count())
            
            <div class="card">
    <div class="card-header">
        <h5 class="card-title">Request Details</h5>
        <!-- Move the form inside the header to the right -->
        <form action="{{ route('admin.adminreq') }}" method="GET" class="search-form">
    <input type="text" id="search-input" name="query" placeholder="Search requests..." value="{{ request()->input('query') }}" oninput="searchRequests()">
</form>
    </div>
    <div id="results">
    <table>
        <thead>
            <tr>
                <th>Person Who claim</th>
                <th>Document Type</th>
                <th>Dry Seal</th>
                <th>Full Name</th>
                <th>Student Number</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($formData as $request)
            <tr>
                <td>{{ $request->user_type }}</td>
                <td>{{ $request->document_type }}</td>
                <td>{{ $request->dry_seal }}</td>
                <td>{{ $request->last_name }}, {{ $request->first_name }} - {{ $request->middle_name }}</td>
                <td>{{ $request->student_number }}</td>
                <td>{{ $request->email }}</td>
                <td>{{ $request->contact }}</td>
                <td>{{ $request->status ?? 'Pending' }}</td>
                <td>
                    @if($request->status === 'Accepted' || $request->status === 'Rejected')
                        <a href="{{ route('edit-request', $request->id) }}" class="btn">Edit</a>
                        <form action="{{ route('delete-request', $request->id) }}" method="POST" style="display:inline;" onsubmit="return confirmAction('Are you sure you want to delete this request?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">Delete</button>
                        </form>
                    @else
                        <a href="{{ route('edit-request', $request->id) }}" class="btn">Edit</a>
                        <form action="{{ route('accept-request', $request->id) }}" method="POST" style="display:inline;" onsubmit="return confirmAction('Are you sure you want to accept this request?');">
                            @csrf
                            <button type="submit" class="btn btn-accept">Accept</button>
                        </form>
                        <form action="{{ route('reject-request', $request->id) }}" method="POST" style="display:inline;" onsubmit="return confirmAction('Are you sure you want to reject this request?');">
                            @csrf
                            <button type="submit" class="btn btn-reject">Reject</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
    <div class="pagination-wrapper" style="padding: 10px;">
    {{ $formData->appends(['query' => request()->query('query')])->links() }}
</div>
    <a href="{{ route('export-requests') }}" class="btn btn-export">Export Data</a>
</div>

            </div>
            @else
            
            <div class="card">
    <div class="card-header">
        <h5 class="card-title">Request Details</h5>
        <!-- Move the form inside the header to the right -->
        <form action="{{ route('admin.adminreq') }}" method="GET" class="search-form">
    <input type="text" id="search-input" name="query" placeholder="Search requests..." value="{{ request()->input('query') }}" oninput="searchRequests()">
</form>
    </div>

        <table>
            <thead>
                <tr>
                    <th>Person Who Claim</th>
                    <th>Document type</th>
                    <th>Dry Seal</th>
                    <th>Full Name</th>
                    <th>Student Number</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Status</th>
                </tr>
            </thead>
            <!-- Table body content here -->
        </table>
        <div class="alert alert-info">NO RESULT FOUND</div>
    </div>
</div>

            @endif
            
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
    <script>
    let debounceTimer;

    function searchRequests() {
        const input = document.getElementById('search-input');
        const query = input.value;

        // Only redirect if there's a query or if the input is cleared
        const url = new URL("{{ route('admin.adminreq') }}");

        // Update query parameter
        if (query) {
            url.searchParams.set('query', query);
        } else {
            url.searchParams.delete('query'); // Remove the query parameter if the input is empty
        }

        // Redirect to the updated URL
        window.location.href = url.toString();
    }

    function handleInput() {
        clearTimeout(debounceTimer); // Clear the previous timer
        debounceTimer = setTimeout(() => {
            // Delay for 300 milliseconds before calling searchRequests
            searchRequests();
        }, 200); // Adjust this delay as needed
    }

    document.addEventListener('DOMContentLoaded', function () {
        const inputField = document.getElementById('search-input');

        // Add event listener for input changes
        inputField.addEventListener('input', handleInput);
    });
</script>

    
</body>

</html>
