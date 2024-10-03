<?php

namespace App\Http\Controllers;

use App\Models\RequestForm; // Ensure this model exists
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Method to display all submitted requests
    public function index()
    {
        // Fetch all request data from the database
        $formData = RequestForm::all(); // Ensure this model exists and is correct

        // Pass the data to the view
        return view('admin.admin', compact('formData'));
    }

    // Method to view a specific request for editing
    public function viewRequest($id)
    {
        // Fetch the request data from the database using the provided ID
        $requestData = RequestForm::findOrFail($id); // Ensure RequestForm is your actual model

        // Return the edit view with the request data
        return view('admin.edit-request', compact('requestData'));
    }

    // Method to show the edit request form
    public function edit($id)
    {
        // Find the request by ID
        $requestData = RequestForm::findOrFail($id);
        
        // Return the edit view with the request data
        return view('admin.edit-request', compact('requestData'));
    }

    // Method to update the request data
    // Update the request data in the database
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'user_type' => 'required',
            'document_type' => 'required',
            'dry_seal' => 'required',
            'name' => 'required|string|max:255',
            'student_number' => 'required|numeric',
            'email' => 'required|email',
            'contact' => 'required|numeric',
        ]);
    
        // Find the request by ID
        $requestData = RequestForm::findOrFail($id);
    
        // Check which action was performed
        if ($request->input('action') === 'accept') {
            // Logic to accept the request
            $requestData->status = 'accepted';
        } elseif ($request->input('action') === 'reject') {
            // Logic to reject the request
            $requestData->status = 'rejected';
        }
    
        // Update the request data
        $requestData->update($request->all());
    
        // Redirect back with a success message
        return redirect()->route('admin.requests')->with('success', 'Request processed successfully!');
    }
    public function showRequests()
{
    // Fetching submitted request data from the database
    $formData = RequestForm::all(); // Replace 'RequestModel' with your actual model name

    return view('admin.user', compact('formData')); // Pass formData to the view
}

    
}
