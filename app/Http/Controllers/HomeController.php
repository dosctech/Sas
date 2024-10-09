<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestForm;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // Method to handle redirection based on user type
    public function index()
    {
        if (Auth::check()) {
            $usertype = Auth::user()->usertype;

            // Redirect based on user type
            return match ($usertype) {
                'user' => view('homeuser'),
                'admin' => $this->adminDashboard(),
                default => redirect()->back(),
            };
        }

        return redirect()->route('login');
    }

    // Admin dashboard method
    public function adminDashboard()
    {
        // Fetch request data for the admin dashboard
        $totalRequests = RequestForm::count();
        $acceptedRequests = RequestForm::where('status', 'accepted')->count();
        $rejectedRequests = RequestForm::where('status', 'rejected')->count();
        
        // Fetch recent requests (last 5 requests)
        $recentRequests = RequestForm::orderBy('created_at', 'desc')->take(5)->get();

        $formData = RequestForm::all(); // Consider paginating this data for large datasets

        // Pass the form data and recent requests to the admin dashboard view
        return view('admin.admin', compact('formData', 'totalRequests', 'acceptedRequests', 'rejectedRequests', 'recentRequests'));
    }

    // Method to view a specific request for editing
    public function viewRequest(RequestForm $requestForm)
    {
        return view('admin.edit-request', compact('requestForm'));
    }

    // Method to edit a specific request
    public function edit(RequestForm $requestForm)
    {
        return view('admin.edit-request', compact('requestForm'));
    }

    // Method to update a request
    public function update(Request $request, RequestForm $requestForm)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'user_type' => 'required',
            'document_type' => 'required',
            'dry_seal' => 'required',
            'name' => 'required|string|max:255',
            'student_number' => 'required|numeric',
            'email' => 'required|email',
            'contact' => 'required|numeric',
        ]);

        // Update the status based on the action
        if ($request->input('action') === 'accept') {
            $requestForm->status = 'Accepted';
        } elseif ($request->input('action') === 'reject') {
            $requestForm->status = 'Rejected';
        }

        // Update the record with validated data
        $requestForm->update($validatedData);

        return redirect()->route('admin.adminreq')->with('success', 'Request processed successfully!');
    }

    // Method to display all requests (admin panel)
    public function showRequests()
    {
        $formData = RequestForm::all();
        return view('admin.user', compact('formData'));
    }

    // Method to display requests for the admin panel
    public function requests()
    {
        $formData = RequestForm::all();
        return view('admin.adminreq', compact('formData'));
    }

    // Method to delete a request
    public function destroy(RequestForm $requestForm)
    {
        $requestForm->delete();
        return redirect()->back()->with('success', 'Request deleted successfully.');
    }
}
