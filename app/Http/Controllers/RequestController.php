<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestForm;

class RequestController extends Controller
{
    // Show the request form
    public function showForm()
    {
        return view('request'); 
    }

    // Submit the request form
    public function submitForm(Request $request)
    {
        // Validate the request data
        $request->validate([
            'user_type' => 'required',
            'document_type' => 'required',
            'name' => 'required|string|max:255',
            'student_number' => 'required|numeric',
            'email' => 'required|email',
            'contact' => 'required|numeric',
            'dry_seal' => 'required|in:yes,no'
        ]);
    
        // Store the data in the database and get the created request
        $requestData = RequestForm::create($request->only([
            'user_type', 
            'document_type', 
            'name', 
            'student_number', 
            'email', 
            'contact', 
            'dry_seal'
        ]));
    
        // Redirect to the read page with a success message
        return redirect()->route('read')->with('success', 'Request submitted successfully!');
    }

    // Display all submitted request data
    public function read()
    {
        // Retrieve all form data from the database
        $formData = RequestForm::all();

        // Return the read view with the form data
        return view('read', compact('formData'));
    }

    // Show the edit form for a specific request
    
}
