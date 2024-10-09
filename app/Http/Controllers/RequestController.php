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
            'student_number' => 'required|regex:/^[0-9-]+$/', // Updated regex to allow hyphens
            'email' => 'required|email',
            'contact' => 'required|regex:/^[0-9-]+$/', // Assuming you want to allow hyphens in contact too
            'dry_seal' => 'required|in:yes,no'
        ]);
        
        // Store the data in the database with the user ID
        $requestData = RequestForm::create($request->only([
            'user_type', 
            'document_type', 
            'name', 
            'student_number', 
            'email', 
            'contact', 
            'dry_seal'
        ]) + ['id' => auth()->id()]); // Add user ID

        // Redirect to the read page with a success message
        return redirect()->route('read')->with('success', 'Request submitted successfully!');
    }

    // Display all submitted request data for the authenticated user
    public function read()
    {
        // Retrieve all form data for the authenticated user
        $formData = RequestForm::where('id', auth()->id())->get();

        // Calculate the counts for accepted and rejected requests
        $acceptedCount = $formData->where('status', 'Accepted')->count();
        $rejectedCount = $formData->where('status', 'Rejected')->count();

        // Return the read view with the form data and counts
        return view('read', compact('formData', 'acceptedCount', 'rejectedCount'));
    }

    // Method to accept a request
    public function accept($id)
    {
        // Find the request by ID and ensure it belongs to the authenticated user
        $requestForm = RequestForm::where('id', $id)->where('id', auth()->id())->firstOrFail();

        // Update the status of the request to 'accepted'
        $requestForm->status = 'Accepted';
        $requestForm->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Request has been accepted successfully.');
    }

    // Method to reject a request
    public function reject($id)
    {
        // Find the request by ID and ensure it belongs to the authenticated user
        $requestForm = RequestForm::where('id', $id)->where('id', auth()->id())->firstOrFail();

        // Update the status of the request to 'rejected'
        $requestForm->status = 'Rejected';
        $requestForm->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Request has been rejected.');
    }
}
