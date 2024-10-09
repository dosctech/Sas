<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Request Form</title>
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
            padding: 15px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .btn {
            background-color: #347928;
            color: white;
            padding: 10px 20px;
            margin: 0 10px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
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
        footer {
            background-color: #347928;
            color: white;
            text-align: center;
            padding: 5px 0;
            position: relative;
            bottom: 0;
            width: 100%;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <img src="{{ asset('image/UniLogo.png') }}" alt="Small Logo" class="small-logo">
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
                        <label for="user_type">Person who Claims</label>
                        <select name="user_type" id="user_type" required>
                            <option value="" disabled selected>Select People</option>
                            <option value="Alumni">Alumni</option>
                            <option value="Current Student">Current Student</option>
                            <option value="Parents">Parents</option>
                        </select>
                    </div>
                    <div>
                        <label for="document_type">Document Type</label>
                        <select name="document_type" id="document_type" required>
                            <option value="" disabled selected>Select Document Type</option>
                            <option value="Form 137">Form 137</option>
                            <option value="COM">COM</option>
                            <option value="COG">COG</option>
                            <option value="TOR">TOR</option>
                            <option value="COE">COE</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="container">
                <h2>User Information</h2>
                <div class="form-row">
                    <div>
                        <label for="name">Student Name</label>
                        <input type="text" name="name" id="name" required>
                    </div>

                    <div>
                        <label for="student_number">Student Number</label>
<input type="text" name="student_number" id="student_number" required pattern="[0-9\-]*" title="Please enter numbers or - only" oninput="validateInput(this)">
                        <span id="error-message" style="color: red; display: none;">Letters not allowed</span>
                    </div>
                </div>

                <div class="form-row">
                    <div>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required>
                    </div>

                    <div>
                        <label for="contact">Contact</label>
                        <input type="text" name="contact" id="contact" required pattern="[03-2223-000715]*" title="Please enter numbers, 0 or - only">
                    </div>
                </div>

                <div class="form-row">
                    <div>
                        <label for="dry_seal">Dry Seal</label>
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
