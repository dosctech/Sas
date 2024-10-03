<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Request Form</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('image/UniLogoj.jpg'); /* Ensure the path is correct */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-position: center top; /* Center the image at the top */
            background-size: contain; /* Adjust to 'contain' to maintain aspect ratio */
            margin: 0;
            padding: 20px;
            color: #333;
            display: flex;
            flex-direction: column; /* Stack items vertically */
            justify-content: center; /* Center content vertically */
            align-items: center; /* Center content horizontally */
            height: 100vh; /* Full height of the viewport */
            background-color: white; /* Optional: add a fallback background color */
        }
        h1 {
            text-align: center;
            color: black;
            margin-bottom: 20px;
            font-size: 2.5em;
            font-weight: bold;
            background: rgba(255, 255, 255, 0.8); /* Optional: white background for better readability */
            padding: 10px;
            border-radius: 5px;
        }
        .container {
            margin-bottom: 15px;
            padding: 20px;
            color: #181C14;
            border: 4px solid #ddd;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.8); /* Light background for form */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1000px; /* Set max width for the form */
        }
        .container h2 {
            margin-top: 0;
            font-size: 1.5em;
            color: #347928;
            border-bottom: 2px solid #181C14;
            padding-bottom: 10px;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 1.1em;
            margin-right: 50px;
        }
        .form-row {
            display: flex;
            justify-content: space-between; /* Align items evenly */
            margin-bottom: 15px; /* Add space between form rows */
        }
        .form-row div {
            flex: 1;
            margin-right: 20px; /* Reduce margin for better spacing */
        }
        .form-row div:last-child {
            margin-right: 0; /* Remove margin for the last child */
        }
        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
            box-sizing: border-box; /* Ensure padding is included in width */
        }
        input[type="text"]:focus,
        input[type="email"]:focus,
        select:focus {
            border-color: #4A90E2;
            outline: none;       
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
            transition: background-color 0.3s, transform 0.3s;
            margin-top: 10px; /* Add margin to the button */
        }
        button:hover {
            background-color: #697565;
            transform: translateY(-2px);
        }
        p.success {
            color: green;
            text-align: center;
            font-size: 1.2em;
            margin-top: 20px;
        }
        @media (max-width: 600px) {
            .form-row {
                flex-direction: column;
            }
            .form-row div {
                margin-right: 0;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
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
                        <input type="text" name="student_number" id="student_number" required pattern="[0-9-]*" title="Please enter numbers, 0 or - only">
                    </div>
                </div>

                <div class="form-row">
                    <div>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required>
                    </div>

                    <div>
                        <label for="contact">Contact</label>
                        <input type="text" name="contact" id="contact" required pattern="[0-9-]*" title="Please enter numbers, 0 or - only">
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
</body>
</html>
