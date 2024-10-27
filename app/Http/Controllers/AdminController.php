<?php

namespace App\Http\Controllers;

use App\Models\RequestForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB; 
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
        $acceptedRequests = RequestForm::where('status', 'Accepted')->count();

        // Calculate the number of rejected requests
        $rejectedRequests = RequestForm::where('status', 'Rejected')->count();

        // Pass the form data and totals to the view
        return view('admin.admin', compact('formData', 'totalRequests', 'acceptedRequests', 'rejectedRequests'));
    }

    // Method to view a specific request for editing
    public function viewRequest($id)
    {
        // Fetch the request data using the provided ID
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'student_number' => 'required|regex:/^[0-9-]+$/',
            'email' => 'required|email',
            'contact' => 'required|regex:/^[0-9-]+$/',
        ]);

        // Find the request by ID
        $requestData = RequestForm::findOrFail($id);

        // Check which action was performed
        if ($request->input('action') === 'accept') {
            $requestData->status = 'Accepted';
        } elseif ($request->input('action') === 'reject') {
            $requestData->status = 'Rejected';
        }

        // Update the request data
        $requestData->update($request->only([
            'user_type',
            'document_type',
            'dry_seal',
            'first_name',
            'last_name',
            'middle_name',
            'student_number',
            'email',
            'contact'
        ]));

        // Redirect back with a success message
        return redirect()->route('admin.adminreq')->with('success', 'Request processed successfully!');
    }

    // Method to show the list of requests with search functionality
    public function requests(Request $request)
    {
        $query = $request->input('query');
    
        // If a search query exists, filter the results
        if ($query) {
            $formData = RequestForm::where(function ($queryBuilder) use ($query) {
                // Search by both full name formats (first_name + last_name) and (last_name + first_name)
                $queryBuilder->where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', "%$query%")
                    ->orWhere(DB::raw("CONCAT(last_name, ' ', first_name)"), 'like', "%$query%")
                    ->orWhere('last_name', 'like', "%$query%")
                    ->orWhere('first_name', 'like', "%$query%")
                    ->orWhere('student_number', 'like', "%$query%")
                    ->orWhere('user_type', 'like', "%$query%")
                    ->orWhere('email', 'like', "%$query%")
                    ->orWhere('dry_seal', 'like', "%$query%")
                    ->orWhere('status', 'like', "%$query%")
                    ->orWhere('document_type', 'like', "%$query%");
            })->paginate(10); // Add pagination after the query builder
        } else {
            $formData = RequestForm::paginate(10);
        }
    
        // Prepare a message based on the results
        $message = $query ? "Showing results for \"$query\": " . $formData->total() . " found." : "Showing all requests.";
    
        return view('admin.adminreq', compact('formData', 'query', 'message'));
    }
    

    // Method to show accepted requests with search functionality
    public function acceptedreq(Request $request)
{
    // Check if there's a search query
    $query = $request->input('query');

    // Filter based on search query or paginate all accepted requests
    if ($query) {
        $formData = RequestForm::where('status', 'Accepted')
            ->where(function ($queryBuilder) use ($query) {
                // Search by individual names or full name (first_name + last_name)
                $queryBuilder->where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', "%$query%")
                    ->orWhere(DB::raw("CONCAT(last_name, ' ', first_name)"), 'like', "%$query%")
                    ->orWhere('last_name', 'like', "%$query%")
                    ->orWhere('first_name', 'like', "%$query%")
                    ->orWhere('student_number', 'like', "%$query%")
                    ->orWhere('user_type', 'like', "%$query%")
                    ->orWhere('email', 'like', "%$query%")
                    ->orWhere('dry_seal', 'like', "%$query%")
                    ->orWhere('status', 'like', "%$query%")
                    ->orWhere('document_type', 'like', "%$query%");
            })
            ->paginate(6); 
    } else {
        // Fetch accepted requests without filtering
        $formData = RequestForm::where('status', 'Accepted')->paginate(6);
    }

    // Fetch accepted requests (if needed separately)
    $recentRequests = RequestForm::where('status', 'Accepted')->get();

    // Return the view with the search query (for display) and filtered results
    return view('admin.acceptedreq', compact('formData', 'recentRequests', 'query'));
}
    

    // Method to show rejected requests
    public function rejectedreq(Request $request)
    {
        // Check if there's a search query
        $query = $request->input('query');
    
        // Initialize the query builder
        $formDataQuery = RequestForm::where('status', 'Rejected');
    
        // Filter based on search query
        if ($query) {
            $formDataQuery->where(function ($queryBuilder) use ($query) {
                // Search by individual names or full name (first_name + last_name)
                $queryBuilder->where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', "%$query%")
                    ->orWhere(DB::raw("CONCAT(last_name, ' ', first_name)"), 'like', "%$query%")
                    ->orWhere('last_name', 'like', "%$query%")
                    ->orWhere('first_name', 'like', "%$query%")
                    ->orWhere('student_number', 'like', "%$query%")
                    ->orWhere('user_type', 'like', "%$query%")
                    ->orWhere('email', 'like', "%$query%")
                    ->orWhere('dry_seal', 'like', "%$query%")
                    ->orWhere('status', 'like', "%$query%")
                    ->orWhere('document_type', 'like', "%$query%");
            });
        }
    
        // Paginate the results
        $formData = $formDataQuery->paginate(6); 
    
        // Return the view with rejected requests
        return view('admin.rejectedreq', compact('formData'));
    }
    

    // Method to export requests to a CSV
    public function exportRequests()
    {
        // Retrieve all requests with their associated users
        $requests = RequestForm::with('user')->get(); 

        // Create the CSV header row
        $csvData = "User ID,User Name,User Email,User Type,User Type (Request),Document Type,Dry Seal,First Name,Last Name,Middle Name,Student Number,Request Email,Contact,Status\n";

        // Append user and request data to the CSV
        foreach ($requests as $request) {
            $user = $request->user;

            // Append user data followed by request data
            $csvData .= "{$user->id},{$user->name},{$user->email},{$user->usertype}," .
                        "{$request->user_type},{$request->document_type},{$request->dry_seal}," .
                        "{$request->first_name},{$request->last_name},{$request->middle_name}," .
                        "{$request->student_number},{$request->email},{$request->contact},{$request->status}\n";
        }

        // Generate a filename with a timestamp
        $fileName = "requests_export_" . date('Y-m-d_H:i:s') . ".csv";

        // Set the headers for the CSV file
        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$fileName",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        // Return the CSV file as a response
        return Response::make($csvData, 200, $headers);
    }
    public function destroy($id)
{
    // Find the item by ID and delete it
    $item = RequestForm::findOrFail($id);
    $item->delete();

    // Redirect back with a success message
    return redirect()->route('admin.adminreq')->with('success', 'Item deleted successfully.');
}
}
