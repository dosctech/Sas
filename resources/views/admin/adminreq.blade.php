<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submitted Request Data</title>
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
        }

        .navbar {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: green;
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
            flex: 1;
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
            height: calc(100vh - 80px);
            overflow-y: auto;
        }

        .content.expanded {
            margin-left: 250px;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
            margin-left: 160px;
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
            background-color: #347928;
            color: white;
        }

        td {
            color: #333;
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

        .btn-accept {
            background-color: #28a745;
        }

        .btn-accept:hover {
            background-color: #218838;
        }

        .btn-reject {
            background-color: #dc3545;
        }

        .btn-reject:hover {
            background-color: #c82333;
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

        function confirmAction(message) {
            return confirm(message);
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
        <h1 class="mb-4">Submitted Request Data</h1>
        <div>
            <x-app-layout></x-app-layout> <!-- Optional, adjust as needed -->
        </div>
    </div>

    <div class="sidebar">
        <a href="{{route ('home')}}">Dashboard</a>
        <a href="{{ route('admin.adminreq') }}">Student Requests</a>
    </div>

    <div class="content">
        <div class="container mt-5">

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
                            <th>Actions</th>
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
                            <td>{{ $request->status ?? 'Pending' }}</td>
                            
                            <td>
                                @if($request->status === 'Accepted' || $request->status === 'Rejected')
                                    <!-- No buttons for Accepted or Rejected statuses -->
                                    <a href="{{ route('edit-request', $request->id) }}" class="btn">Edit</a>
                                    <form action="{{ route('delete-request', $request->id) }}" method="POST" style="display:inline;" onsubmit="return confirmAction('Are you sure you want to delete this request?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-reject">Delete</button>
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
                    </table>
                </div>
            </div>
            @else
            <div class="alert alert-info">No requests found.</div>
            @endif
        </div>
    </div>
</body>

</html>
