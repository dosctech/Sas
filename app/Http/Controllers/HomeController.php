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
        $acceptedRequestsCount = RequestForm::where('status', 'accepted')->count();
        $rejectedRequestsCount = RequestForm::where('status', 'rejected')->count();

        $rejectedPage = request()->get('rejected_page', 1); // Default to page 1 if not set
  // Custom page name for rejected requests
        $acceptedPage = request()->get('accepted_page', 1);  // Custom page name for accepted requests
        $recentPage = request()->get('recent_page', 1);      // Custom page name for recent requests
        
        // Fetch the recent requests
        $recentRequests = RequestForm::where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Create the paginator for recent requests
        $paginatedRecentRequests = RequestForm::where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'recent_page', $recentPage);
    
        
        // Fetch the rejected requests
        $rejectedRequests = RequestForm::where('status', 'rejected',)
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Create the paginator for rejected requests
        $paginatedRejectedRequests = RequestForm::where('status', 'rejected')
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'rejected_page',$rejectedPage);
        
        // Fetch the accepted requests
        $acceptedRequests = RequestForm::where('status', 'accepted')
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Create the paginator for accepted requests
        $paginatedAcceptedRequests = RequestForm::where('status', 'accepted')
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'accepted_page', $acceptedPage);

        $formData = RequestForm::all(); // Consider paginating this data for large datasets

        // Pass the form data and recent requests to the admin dashboard view
        $search = request()->get('search'); // Get the search query from the input

    $recentRequestsQuery = RequestForm::where('status', 'pending');
    $rejectedRequestsQuery = RequestForm::where('status', 'rejected');
    $acceptedRequestsQuery = RequestForm::where('status', 'accepted');

    // Apply search filter if there is a search query
    if ($search) {
        $recentRequestsQuery->where(function($query) use ($search) {
            $query->where('first_name', 'LIKE', '%' . $search . '%')
                  ->orWhere('last_name', 'LIKE', '%' . $search . '%')
                  ->orWhere('middle_name', 'LIKE', '%' . $search . '%')
                  ->orWhere('user_type', 'LIKE', '%' . $search . '%')  // Replace 'name' with your search field
                  ->orWhere('student_number', 'LIKE', '%' . $search . '%')
                  ->orWhere('status', 'LIKE', '%' . $search . '%');// Add more fields as needed
        });

        $rejectedRequestsQuery->where(function($query) use ($search) {
            $query->where('first_name', 'LIKE', '%' . $search . '%')
                ->orWhere('last_name', 'LIKE', '%' . $search . '%')
                ->orWhere('middle_name', 'LIKE', '%' . $search . '%') 
                ->orWhere('user_type', 'LIKE', '%' . $search . '%') 
                  ->orWhere('student_number', 'LIKE', '%' . $search . '%')
                  ->orWhere('status', 'LIKE', '%' . $search . '%');
        });

        $acceptedRequestsQuery->where(function($query) use ($search) {
            $query->where('first_name', 'LIKE', '%' . $search . '%')
                ->orWhere('last_name', 'LIKE', '%' . $search . '%')
                ->orWhere('middle_name', 'LIKE', '%' . $search . '%') 
                ->orWhere('user_type', 'LIKE', '%' . $search . '%') 
                  ->orWhere('student_number', 'LIKE', '%' . $search . '%')
                  ->orWhere('status', 'LIKE', '%' . $search . '%');
        });
    }

    // Fetch the requests after applying the filters
    $paginatedRecentRequests = $recentRequestsQuery->orderBy('created_at', 'desc')->paginate(10, ['*'], 'recent_page', $recentPage);
    $paginatedRejectedRequests = $rejectedRequestsQuery->orderBy('created_at', 'desc')->paginate(10, ['*'], 'rejected_page', $rejectedPage);
    $paginatedAcceptedRequests = $acceptedRequestsQuery->orderBy('created_at', 'desc')->paginate(10, ['*'], 'accepted_page', $acceptedPage);

    // Existing code...

    // Pass the search query back to the view
    return view('admin.admin', compact('paginatedRejectedRequests', 'paginatedAcceptedRequests', 'formData', 'totalRequests', 'rejectedRequestsCount', 'acceptedRequestsCount', 'acceptedRequests', 'rejectedRequests', 'recentRequests', 'paginatedRecentRequests', 'search'));
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
