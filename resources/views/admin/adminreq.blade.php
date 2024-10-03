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
            padding: 0;
            background-image: url('image/UniLogoj.jpg');
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            display: flex;
            overflow: hidden;
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
            padding: 20px;
        }

        .sidebar.open {
            left: 0;
        }

        .sidebar h3 {
            color: #333;
        }

        .sidebar a {
            display: block;
            color: #000;
            text-decoration: none;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #efefef;
        }

        .toggle-btn {
            position: fixed;
            left: 10px;
            top: 10px;
            background-color: #4A90E2;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            z-index: 1001;
        }

        .content {
            margin-left: 20px;
            padding: 20px;
            flex-grow: 1;
            transition: margin-left 0.3s ease;
            height: 100vh;
            overflow-y: auto; /* Enable vertical scrolling */
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
        }

        .card-title {
            font-size: 1.5em;
            font-weight: 500;
            color: black;
            margin-bottom: 15px;
            border-bottom: 2px solid #4A90E2;
            padding-bottom: 10px;
        }

        h1 {
            text-align: center;
            color: black;
            margin-bottom: 20px;
            font-size: 4em !important;
            font-weight: 700;
        }

        .alert {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
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

        /* Dashboard navigation styles */
        .dashboard {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 10px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .dashboard div {
            text-align: center;
        }

        .dashboard div h3 {
            margin: 0;
            font-size: 1.2em;
            color: #333;
        }

        .dashboard div p {
            margin: 0;
            font-size: 0.9em;
            color: #777;
        }

        /* Hamburger icon */
        .toggle-btn::before {
            content: "\2630"; /* Unicode for hamburger menu */
            font-size: 1.5em;
        }
    </style>
    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const content = document.querySelector('.content');
            sidebar.classList.toggle('open');
            content.classList.toggle('expanded');
        }
    </script>
</head>

<body>
    <button class="toggle-btn" onclick="toggleSidebar()"></button>
    
    <div class="sidebar">
        <h3>Dashboard</h3>
        <a href="#accepted">Accepted Requests</a>
        <a href="#rejected">Rejected Requests</a>
        <a href="#deleted">Deleted Requests</a>
        <a href="#reports">Reports</a>
        <a href="#settings">Settings</a>
        <x-app-layout></x-app-layout>
    </div>

    <div class="content">
        <div class="container mt-5">
            <h1 class="mb-4">Submitted Request Data</h1>

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
                                <a href="{{ route('edit-request', $request->id) }}" class="btn">Edit</a>
                                <form action="{{ route('accept-request', $request->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-accept">Accept</button>
                                </form>
                                <form action="{{ route('reject-request', $request->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-reject">Reject</button>
                                </form>
                            </td>
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
    </div>
</body>

</html>
