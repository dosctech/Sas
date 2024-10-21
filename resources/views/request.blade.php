<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Request Form</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('image/UpangFav.ico') }}">
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
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
        header {
            display: flex;
            justify-content: space-between; 
            align-items: center; 
            padding: 5px;
            background-color: #D8D9DA;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        }
        .btn {
            background-color: #185519;
            color: white; 
            padding: 6px 12px; 
            margin-left: 10px; 
            text-decoration: none; 
            border-radius: 5px;
            display: inline-block; 
            font-size: 14px; 
            transition: background-color 0.3s; 
        }
        .btn:hover {
            background-color: #FEC260;
        }
        .small-logo {
            width: 80px;
            height: auto;
            margin-left: 155px;
        }
        .button-container {
            margin-right: 10px;
        }
        .container {
            padding: 20px;
            color: #181C14;
            border: 4px solid #ddd;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            margin: 20px auto;
        }
        h1 {
            text-align: center;
            color: black;
            margin-bottom: 20px;
            font-size: 2.5em;
            font-weight: bold;
            background: rgba(255, 255, 255, 0.8);
            padding: 10px;
            border-radius: 5px;
        }
        h2 {
            font-size: 1.5em;
            color: #347928;
            border-bottom: 2px solid #181C14;
            padding-bottom: 10px;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 1.1em;
        }
        input[type="text"], input[type="email"], select {
            width: 96%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 15px;
        }
        
        /* Separate styles for dropdowns */
        #user_type {
            width: 98%;
            background-color: #F0F8FF;
            border-color: #347928;
            font-weight: bold;
        }
        
        #document_type {
            width: 98%;
            background-color: #FFF0F5;
            border-color: #FEC260;
            font-weight: bold;
        }
        
        #dry_seal {
            width: 98%;
            background-color: #FFFFE0;
            border-color: #8B0000;
            font-weight: bold;
        }
        .form-row {
            margin-bottom: 15px; /* Space between rows */
        }

            .form-row div {
                flex: 1; /* Make each input take equal space */
            }

            input[type="text"], input[type="email"], select {
                width: 100%; /* Full width */
                padding: 8px; /* Padding inside input */
                box-sizing: border-box; /* Include padding in width */
            }

        button {
            width: 100%;
            padding: 12px;
            background-color: #347928;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }
        button:hover {
            background-color: #697565;
        }
        .required {
            color: red;
        }
        
        footer {
            background-color: #185519;
            color: white;
            text-align: center;
            padding: 8px;
            position: relative;
            bottom: 0;
            width: 100%;
            font-size: 9px;
        }
        
    </style>
</head>
<body>
    <!-- Header -->
    <header>
    <a href="/home">
                <img src="{{ asset('image/UniLogo.png') }}" alt="Small Logo" class="small-logo">
            </a>
        <div class="button-container">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/read') }}" class="btn">Request Details</a>
                    <a href="{{ route('request') }}" class="btn">Request</a>
                @endauth
            @endif
        </div>
    </header>

    <!-- Main Content -->
    <div>
        <h1>Request Documents</h1>

        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        <form action="{{ route('submit-request') }}" method="POST">
            @csrf

            <div class="container">
            <h2>Request Information</h2>
            <div class="form-row">
                <div>
                    <label for="user_type">Person who Claims <span class="required">*</span></label>
                    <select name="user_type" id="user_type" required>
                        <option value="" disabled selected>Select Person</option>
                        <option value="Alumni">Alumni</option>
                        <option value="Current Student">Current Student</option>
                        <option value="Parents">Parents</option>
                        <option value="Guardian">Guardian</option>
                        <option value="Teacher">Teacher</option>
                    </select>
                </div>

                <div>
                    <label for="document_type">Document Type <span class="required">*</span></label>
                    <select name="document_type" id="document_type" required>
                        <option value="" disabled selected>Select Document Type</option>
                        <option value="Form137">Form 137</option>
                        <option value="Form138- Report Card">Form 138 - Report Card</option>
                        <option value="COM - Certificate of Matriculation">COM - Certificate of Matriculation</option>
                        <option value="COG - Copy of Grades">COG - Copy of Grades</option>
                        <option value="TOR - Transcript of Records">TOR - Transcript of Records</option>
                        <option value="COE - Certificate of Enrollment">COE - Certificate of Enrollment</option>
                        <option value="Diploma">Diploma</option>
                        <option value="AcademicRecords">Academic Records</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="container">
            <h2>User Information</h2>
            <div class="form-row">
                <div style="display: flex; gap: 10px;">
                    <div>
                        <label for="last_name">Last Name <span class="required">*</span></label>
                        <input type="text" name="last_name" id="last_name" required>
                    </div>

                    <div>
                        <label for="first_name">First Name <span class="required">*</span></label>
                        <input type="text" name="first_name" id="first_name" required>
                    </div>

                    <div>
                        <label for="middle_name">Middle Name</label>
                        <input type="text" name="middle_name" id="middle_name">
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="student_number">Student Number <span class="required">*</span></label>
                    <input type="text" name="student_number" id="student_number" required pattern="[0-9\-]*" title="Please enter numbers or - only" oninput="validateInput(this)">
                    <span id="error-message" style="color: red; display: none;">Letters not allowed</span>
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="email">Email <span class="required">*</span></label>
                    <input type="email" name="email" id="email" required>
                </div>

                <div>
                    <label for="contact">Contact <span class="required">*</span></label>
                    <input type="text" name="contact" id="contact" required pattern="[0-9\-]*" title="Please enter numbers or - only">
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="dry_seal">Dry Seal <span class="required">*</span></label>
                    <select name="dry_seal" id="dry_seal" required>
                        <option value="" disabled selected>Select Dry Seal Option</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
            </div>
        
    <button type="submit">Submit</button>
</div>

        </form>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; {{ date('Y') }} University of Pangasinan. All rights reserved.</p>
        <p>Contact us: phinmaed@gmail.com</p>
    </footer>

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
</body>
</html>
