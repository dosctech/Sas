<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submitted Request Data</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7fa;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: black;
            margin-bottom: 20px;
            font-size: 2.5em;
            font-weight: 700;
        }

        .alert {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .card {
            background-color: #ffffff;
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
            border-bottom: 2px solid #4A90E2;
            padding-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #347928;
            color: white;
        }

        td {
            color: #333;
        }

        .notification {
            position: relative;
            display: inline-block;
            margin-left: auto;
            cursor: pointer; /* Make it clear that the icon is clickable */
        }

        .notification-icon {
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
            margin: 0;
            cursor: pointer;
            padding: 5px 0; /* Adds some padding for a better clickable area */
        }

        .dropdown-content p:hover {
            background-color: #f1f1f1; /* Highlight effect on hover */
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
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
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Submitted Request Data</h1>

        <!-- Notification Icon -->
        <div class="notification" onclick="toggleDropdown()">
            <span class="notification-icon">&#128276;</span>
            <span class="notification-badge" id="notificationBadge">{{ $acceptedCount + $rejectedCount }}</span>
            <div class="dropdown" id="notificationDropdown">
                <div class="dropdown-content">
                    @foreach($formData as $request)
                        @if($request->status === 'Accepted')
                            <p onclick="handleDropdownClick('Student: {{ $request->name }}, Number: {{ $request->student_number }} - Your request is now accepted. ✔️')">
                                ✔️ {{ $request->name }} ({{ $request->student_number }}) - Your request is now accepted.
                                <br>See you at Registrar University of Pangasinan.
                            </p>
                        @elseif($request->status === 'Rejected')
                            <p onclick="handleDropdownClick('Student: {{ $request->name }}, Number: {{ $request->student_number }} - Your request is now rejected. ❌')">
                                ❌ {{ $request->name }} ({{ $request->student_number }}) - Your request is now rejected.
                                <br>See you at Registrar University of Pangasinan.
                            </p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($formData->count())
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Request Details</h5>
                    <table>
                        <tr>
                            <th>User Type</th>
                            <th>Document Type</th>
                            <th>Dry Seal</th>
                            <th>Name</th>
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
                            <td>{{ $request->name }}</td>
                            <td>{{ $request->student_number }}</td>
                            <td>{{ $request->email }}</td>
                            <td>{{ $request->contact }}</td>
                            <td>{{ $request->status ?? 'Pending' }}</td> <!-- Assuming a status column; default to 'Pending' if not set -->
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        @else
            <div class="alert alert-info">
                No requests submitted yet.
            </div>
        @endif

    </div>
</body>
</html>
