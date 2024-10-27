<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Request</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('image/UpangFav.ico') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
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

        .container {
            max-width: 600px;
            margin: auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Edit Request</h1>
        <form action="{{ route('requests.update', $request->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="user_type">User Type</label>
                <input type="text" name="user_type" id="user_type" value="{{ $request->user_type }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="document_type">Document Type</label>
                <input type="text" name="document_type" id="document_type" value="{{ $request->document_type }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="dry_seal">Dry Seal</label>
                <input type="text" name="dry_seal" id="dry_seal" value="{{ $request->dry_seal }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ $request->name }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="student_number">Student Number</label>
                <input type="text" name="student_number" id="student_number" value="{{ $request->student_number }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ $request->email }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="contact">Contact</label>
                <input type="text" name="contact" id="contact" value="{{ $request->contact }}" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
