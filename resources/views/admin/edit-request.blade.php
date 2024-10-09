<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Request</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Edit Request</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('update-request', ['id' => $requestData->id]) }}" method="POST">
            @csrf
            @method('POST') <!-- Simulate the PUT request -->

            <!-- Form fields -->
            <div class="form-group">
                <label for="user_type">User Type</label>
                <select class="form-control" id="user_type" name="user_type" required>
                    <option value="" disabled {{ $requestData->user_type ? '' : 'selected' }}>Select User Type</option>
                    <option value="student" {{ $requestData->user_type == 'student' ? 'selected' : '' }}>Student</option>
                    <option value="teacher" {{ $requestData->user_type == 'teacher' ? 'selected' : '' }}>Teacher</option>
                    <option value="staff" {{ $requestData->user_type == 'staff' ? 'selected' : '' }}>Staff</option>
                </select>
            </div>

            <div class="form-group">
                <label for="document_type">Document Type</label>
                <select class="form-control" id="document_type" name="document_type" required>
                    <option value="" disabled {{ $requestData->document_type ? '' : 'selected' }}>Select Document Type</option>
                    <option value="transcript" {{ $requestData->document_type == 'transcript' ? 'selected' : '' }}>Transcript</option>
                    <option value="certificate" {{ $requestData->document_type == 'certificate' ? 'selected' : '' }}>Certificate</option>
                    <option value="id_card" {{ $requestData->document_type == 'id_card' ? 'selected' : '' }}>ID Card</option>
                </select>
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $requestData->name }}" required>
            </div>

            <div class="form-group">
                <label for="student_number">Student Number</label>
                <input type="text" class="form-control" id="student_number" name="student_number" value="{{ $requestData->student_number }}" required pattern="[0-9\-]*" title="Please enter numbers or - only" oninput="validateInput(this)">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $requestData->email }}" required>
            </div>

            <div class="form-group">
                <label for="contact">Contact</label>
                <input type="text" class="form-control" id="contact" name="contact" value="{{ $requestData->contact }}" required pattern="[0-9\-]*" title="Please enter numbers or - only" oninput="validateInput(this)">
            </div>

            <div class="form-group">
                <label for="dry_seal">Dry Seal</label>
                <select class="form-control" id="dry_seal" name="dry_seal" required>
                    <option value="yes" {{ $requestData->dry_seal == 'yes' ? 'selected' : '' }}>Yes</option>
                    <option value="no" {{ $requestData->dry_seal == 'no' ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary">Update Request</button>
            <a href="{{ route('admin.adminreq') }}" class="btn btn-secondary">Cancel</a>
        </form>

    </div>
    <script>
        function validateInput(input) {
            const errorMessage = document.getElementById('error-message');
            // Regular expression to check for letters
            const hasLetters = /[a-zA-Z]/.test(input.value);

            if (hasLetters) {
                errorMessage.style.display = 'inline'; // Show error message
                input.value = input.value.replace(/[a-zA-Z]/g, ''); // Remove letters from input
            } else {
                errorMessage.style.display = 'none'; // Hide error message
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
