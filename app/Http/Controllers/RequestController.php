<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestForm;
use Illuminate\Support\Facades\Auth; // Import Auth facade

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
            'first_name' => 'required|string|max:255',  // Validate first name
            'last_name' => 'required|string|max:255',   // Validate last name
            'middle_name' => 'nullable|string|max:255', // Validate middle name (optional)
            // Allow numbers and hyphens in student_number
            'student_number' => 'required|regex:/^[0-9\-]+$/',
            'email' => 'required|email',
            // Allow numbers and hyphens in contact
            'contact' => 'required|regex:/^[0-9\-]+$/',
            'dry_seal' => 'required|in:yes,no'
        ]);
        
        // Store the data in the database and get the created request
        $requestData = RequestForm::create(array_merge(
            $request->only([
                'user_type', 
                'document_type', 
                'first_name',     // Store first name
                'last_name',      // Store last name
                'middle_name',    // Store middle name
                'student_number', 
                'email', 
                'contact', 
                'dry_seal'
            ]),
            ['user_id' => Auth::id()] // Assign the authenticated user's ID
        ));
        
        // Redirect to the read page with a success message
        return redirect()->route('read')->with('success', 'Request submitted successfully!');
    }

    // Display all submitted request data for the authenticated user
    public function read()
    {
        // Retrieve form data belonging to the authenticated user
        $formData = RequestForm::where('user_id', Auth::id())->get(); // Only fetch requests by the authenticated user

        // Calculate the counts for accepted and rejected requests
        $acceptedCount = $formData->where('status', 'Accepted')->count();
        $rejectedCount = $formData->where('status', 'Rejected')->count();

        // Return the read view with the form data and counts
        return view('read', compact('formData', 'acceptedCount', 'rejectedCount'));
    }

    // Method to accept a request
    public function accept($id)
    {
        // Find the request by ID
        $requestForm = RequestForm::findOrFail($id);

        // Ensure the request belongs to the authenticated user
        

        // Update the status of the request to 'accepted'
        $requestForm->status = 'Accepted';
        $requestForm->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Request has been accepted successfully.');
    }

    // Method to reject a request
    public function reject($id)
    {
        // Find the request by ID
        $requestForm = RequestForm::findOrFail($id);

        // Ensure the request belongs to the authenticated user
       

        // Update the status of the request to 'rejected'
        $requestForm->status = 'Rejected';
        $requestForm->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Request has been rejected.');
    }
}
