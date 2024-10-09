<?php

namespace App\Http\Controllers;

use App\Models\RequestForm;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Method to display the admin dashboard
    public function index()
    {
        // Fetch all request data from the database
        $formData = RequestForm::all();

        // Calculate the total number of requests
        $totalRequests = $formData->count();

        // Calculate the number of accepted requests
        $acceptedRequests = RequestForm::where('status', 'accepted')->count();

        // Calculate the number of rejected requests
        $rejectedRequests = RequestForm::where('status', 'rejected')->count();

        // Pass the form data and total requests to the view
        return view('admin.admin', compact('formData', 'totalRequests', 'acceptedRequests', 'rejectedRequests'));
    }

    // Method to view a specific request for editing
    public function viewRequest($id)
    {
        // Fetch the request data from the database using the provided ID
        $requestData = RequestForm::findOrFail($id);

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
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'user_type' => 'required',
            'document_type' => 'required',
            'dry_seal' => 'required|in:yes,no',
            'name' => 'required|string|max:255',
            'student_number' => 'required|regex:/^[0-9-]+$/',
            'email' => 'required|email',
            'contact' => 'required|regex:/^[0-9-]+$/',
        ]);

        // Find the request by ID
        $requestData = RequestForm::findOrFail($id);

        // Check which action was performed
        if ($request->input('action') === 'accept') {
            // Logic to accept the request
            $requestData->status = 'Accepted';
        } elseif ($request->input('action') === 'reject') {
            // Logic to reject the request
            $requestData->status = 'Rejected';
        }

        // Update the request data
        $requestData->update($request->all());

        // Redirect back with a success message
        return redirect()->route('admin.adminreq')->with('success', 'Request processed successfully!');
    }

    // Method to show the list of requests
    public function showRequests()
    {
        // Fetching submitted request data from the database
        $formData = RequestForm::all();

        return view('admin.user', compact('formData'));
    }
    // Add this method to AdminController
public function requests()
{
    // Fetch all requests from the database
    $formData = RequestForm::all();

    // Return the view with all requests
    return view('admin.adminreq', compact('formData'));
}
public function destroy($id)
{
    $request = RequestForm::findOrFail($id); // Replace YourModel with your actual model name
    $request->delete();

    return redirect()->back()->with('success', 'Request deleted successfully.');
}


}
