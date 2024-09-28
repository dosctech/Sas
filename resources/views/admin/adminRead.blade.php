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
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Submitted Request Data</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($formData)
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
                            <th>Action</th> <!-- New Action column -->
                        </tr>
                        <tr>
                            <td>{{ $formData['user_type'] }}</td>
                            <td>{{ $formData['document_type'] }}</td>
                            <td>{{ $formData['dry_seal'] }}</td>
                            <td>{{ $formData['name'] }}</td>
                            <td>{{ $formData['student_number'] }}</td>
                            <td>{{ $formData['email'] }}</td>
                            <td>{{ $formData['contact'] }}</td>
                            <td>
                                <a href="{{ route('edit-request', ['id' => session('formData.id')]) }}" class="btn">Edit</a>
                            </td> <!-- Edit button in the Action column -->
                        </tr>
                    </table>
                </div>
            </div>
        @endif

    </div>
</body>
</html>
