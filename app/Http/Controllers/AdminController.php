<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function store(Request $request)
    {
        // Validate your input
        $request->validate([
            'name' => 'required|string|max:255',
            'student_number' => 'required|string', // Adjust validation as needed
            'email' => 'nullable|email',
            'contact' => 'nullable|string', // If you expect alphanumeric
            'dry_seal' => 'required|string',
        ]);
    
        // Store the form data (if needed, e.g., save to the database)
    
        // Pass the data to the admin view
        return view('admin.page', [
            'formData' => $request->all() // Pass all form data
        ]);
    }
    
}
