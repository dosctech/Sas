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
    
        // Store data in session, including the ID
        session(['formData' => array_merge($request->only([
            'user_type', 
            'document_type', 
            'name', 
            'student_number', 
            'email', 
            'contact', 
            'dry_seal'
        ]), ['id' => $requestData->id])]);
    
        // Redirect to the read page with a success message
        return redirect()->route('read')->with('success', 'Request submitted successfully!');
    }

    // Display the submitted request data
    public function read()
    {
        // Retrieve the form data from the session
        $formData = session('formData');

        // Return the read view with the form data
        return view('read', compact('formData'));
    }

    // Show the edit form for a specific request
    public function edit($id)
    {
        $requestData = RequestForm::findOrFail($id); // Ensure to handle not found case

        // Return the edit view with the request data
        return view('edit-request', compact('requestData'));
    }

    // Update the request data in the database
    public function update(Request $request, $id)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'user_type' => 'required|string',
            'document_type' => 'required|string',
            'name' => 'required|string|max:255',
            'student_number' => 'required|numeric',
            'email' => 'required|email',
            'contact' => 'required|numeric',
            'dry_seal' => 'required|string',
        ]);
    
        // Find the request record by id and update it
        $requestData = RequestForm::findOrFail($id);
        $requestData->update($validatedData);
    
        // Redirect after updating
        return redirect()->route('read')->with('success', 'Request updated successfully.');
    }
    
    
    
}
