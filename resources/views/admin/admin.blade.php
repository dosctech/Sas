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
            background-size: cover; /* Cover the entire viewport */
            background-position: center; /* Center the image */
            color: #333;
            margin: 0;
            padding: 0;
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
            background-color: green; /* Changed to green */
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            z-index: 1001;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            height: 30px;
            width: 35px;
            transition: transform 0.3s ease;
        }

        .toggle-btn span {
            background-color: green; /* Changed to green */
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
            height: 100vh;
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
            color: black; /* Keeping the title black */
            margin-bottom: 15px;
            border-bottom: 2px solid green; /* Changed to green */
            padding-bottom: 10px;
        }

        .content h1 {
            text-align: center;
            color: green; /* Changed to green */
            margin-bottom: 20px;
            font-size: 4em; /* Increased font size */
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

    <div class="sidebar">
        <h3>Dashboard</h3>
        <a href="#deleted">Student Requests</a>
        <a href="#accepted">Accepted Requests</a>
        <a href="#rejected">Rejected Requests</a>
        <a href="#deleted">Deleted Requests</a>
        <a href="#settings">Settings</a>
        <x-app-layout></x-app-layout>
    </div>

    <div class="content">
        <h1>Admin Dashboard</h1>

        <div class="dashboard">
            <div>
                <h3>Total Appointments</h3>
                <p>150</p>
            </div>
            <div>
                <h3>Accepted</h3>
                <p>120</p>
            </div>
            <div>
                <h3>Rejected</h3>
                <p>20</p>
            </div>
        </div>

        <div class="card" id="accepted">
            <div class="card-title">Accepted Requests</div>
            <p>Here you can view all accepted requests. Use the table below to manage appointments.</p>
            <!-- Add your table or content for accepted requests -->
        </div>

        <div class="card" id="rejected">
            <div class="card-title">Rejected Requests</div>
            <p>Here you can view all rejected requests and reasons for rejection.</p>
            <!-- Add your table or content for rejected requests -->
        </div>

        <div class="card" id="deleted">
            <div class="card-title">Deleted Requests</div>
            <p>Manage deleted requests here. You can choose to restore or permanently delete requests.</p>
            <!-- Add your table or content for deleted requests -->
        </div>

        <div class="card" id="settings">
            <div class="card-title">Settings</div>
            <p>Configure your admin settings and system preferences.</p>
            <!-- Add your settings options -->
        </div>
    </div>
</body>

</html>
