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
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            background-color: white;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            padding: 20px;
            color: #181C14;
            border: 4px solid #ddd;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            margin: 20px auto;
        }
        .section-header {
            font-size: 1.5em;
            color: #347928;
            border-bottom: 2px solid #181C14;
            padding-bottom: 10px;
        }
        .form-group {
            font-weight: bold;
            margin-bottom: 20px;
        }
        .form-control {
            border: 2px solid #ced4da; /* Default border color */
            font-size: 1em; /* Set font size for input fields */
        }
        .form-control:focus {
            border-color: #28a745; /* Focus border color */
            box-shadow: 0 0 5px rgba(40, 167, 69, .5); /* Focus shadow */
        }
        /* Specific dropdown background colors */
        #user_type {
            width: 100%;
            background-color: #F0F8FF;
            border-color: #347928;
            font-weight: bold;
        }
        
        #document_type {
            width: 100%;
            background-color: #FFF0F5;
            border-color: #FEC260;
            font-weight: bold;
        }
        
        #dry_seal {
            width: 100%;
            background-color: #FFFFE0;
            border-color: #8B0000;
            font-weight: bold;
        }
        .btn-submit {
            width: 40%;
            padding: 12px;
            background-color: #347928;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
            margin-left: 56px;
        }
        .btn-submit:hover {
            background-color: #218838;
        }
        .btn-cancel {
            width: 40%;
            padding: 10px;
            background-color: grey;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
            margin-right: 56px;
        }
        .btn-cancel:hover {
            background-color: #5a6268;
        }
        .required {
            color: red;
            margin-left: 5px;
        }
        .name-inputs {
            display: flex;
            justify-content: space-between; /* Space between inputs */
        }
        .name-input {
            flex: 1; /* Allow inputs to grow equally */
            margin-right: 10px; /* Space between inputs */
        }
        .name-input:last-child {
            margin-right: 0; /* Remove margin for the last input */
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
            font-size: 56px; /* Increased font size */
            text-align: center; /* Center the text */
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
            margin: 30px 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: black;
        }
    </style>
</head>
<body>
<div class="navbar">
        
        <h1>Edit Request</h1>
        
    </div>
    <div class="container">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('update-request', ['id' => $requestData->id]) }}" method="POST">
            @csrf
            @method('POST') <!-- Simulate the PUT request -->

            <!-- Request Information Section -->
            <div class="card">
                <h2 class="section-header">Request Information</h2>

                <div class="form-group">
                    <label for="user_type">Person who Claims <span class="required">*</span></label>
                    <select class="form-control" id="user_type" name="user_type" required>
                        <option value="" disabled {{ $requestData->user_type ? '' : 'selected' }}>Select People</option>
                        <option value="Alumni" {{ $requestData->user_type == 'alumni' ? 'selected' : '' }}>Alumni</option>
                        <option value="Current Student" {{ $requestData->user_type == 'current_student' ? 'selected' : '' }}>Current Student</option>
                        <option value="Parents" {{ $requestData->user_type == 'parents' ? 'selected' : '' }}>Parents</option>
                        <option value="Guardian" {{ $requestData->user_type == 'guardian' ? 'selected' : '' }}>Guardian</option>
                        <option value="Teacher" {{ $requestData->user_type == 'teacher' ? 'selected' : '' }}>Teacher</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="document_type">Document Type <span class="required">*</span></label>
                    <select class="form-control" id="document_type" name="document_type" required>
                        <option value="" disabled {{ $requestData->document_type ? '' : 'selected' }}>Select Document Type</option>
                        <option value="Form 137" {{ $requestData->document_type == 'form_137' ? 'selected' : '' }}>Form 137</option>
                        <option value="Form 138 - Report Card" {{ $requestData->document_type == 'form_138' ? 'selected' : '' }}>Form 138 - Report Card</option>
                        <option value="COM - Certificate of Matriculation" {{ $requestData->document_type == 'com' ? 'selected' : '' }}>COM - Certificate of Matriculation</option>
                        <option value="COG - Copy Of Grades" {{ $requestData->document_type == 'cog' ? 'selected' : '' }}>COG - Copy Of Grades</option>
                        <option value="TOR - Transcript of Records<" {{ $requestData->document_type == 'tor' ? 'selected' : '' }}>TOR - Transcript of Records</option>
                        <option value="COE - Certificate of Enrollment" {{ $requestData->document_type == 'coe' ? 'selected' : '' }}>COE - Certificate of Enrollment</option>
                        <option value="Diploma" {{ $requestData->document_type == 'diploma' ? 'selected' : '' }}>Diploma</option>
                        <option value="Academic Records" {{ $requestData->document_type == 'academic_records' ? 'selected' : '' }}>Academic Records</option>
                    </select>
                </div>


            </div>

            <!-- User Information Section -->
            <div class="card">
                <h2 class="section-header">User Information</h2>

                <div class="form-group name-inputs">
                    <div class="name-input">
                        <label for="last_name">Last Name <span class="required">*</span></label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="{{ $requestData->last_name }}" required>
                    </div>
                    <div class="name-input">
                        <label for="first_name">First Name <span class="required">*</span></label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="{{ $requestData->first_name }}" required>
                    </div>
                    <div class="name-input">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name" value="{{ $requestData->middle_name }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="student_number">Student Number <span class="required">*</span></label>
                    <input type="text" class="form-control" id="student_number" name="student_number" value="{{ $requestData->student_number }}" required pattern="[0-9\-]*" title="Please enter numbers or - only" oninput="validateInput(this)">
                </div>

                <div class="form-group">
                    <label for="email">Email <span class="required">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $requestData->email }}" required>
                </div>

                <div class="form-group">
                    <label for="contact">Contact <span class="required">*</span></label>
                    <input type="text" class="form-control" id="contact" name="contact" value="{{ $requestData->contact }}" required pattern="[0-9\-]*" title="Please enter numbers or - only" oninput="validateInput(this)">
                </div>
                <div class="form-group">
                    <label for="dry_seal">Dry Seal <span class="required">*</span></label>
                    <select class="form-control" id="dry_seal" name="dry_seal" required>
                        <option value="" disabled {{ $requestData->dry_seal ? '' : 'selected' }}>Select Dry Seal Option</option>
                        <option value="yes" {{ $requestData->dry_seal == 'yes' ? 'selected' : '' }}>Yes</option>
                        <option value="no" {{ $requestData->dry_seal == 'no' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>

            <!-- Submit and Cancel buttons -->
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-submit">Submit</button>
                <a href="{{ route('admin.adminreq') }}" class="btn btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
    
    <script>
        function validateInput(input) {
            // Regular expression to check for letters
            const hasLetters = /[a-zA-Z]/.test(input.value);

            if (hasLetters) {
                input.value = input.value.replace(/[a-zA-Z]/g, ''); // Remove letters from input
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
