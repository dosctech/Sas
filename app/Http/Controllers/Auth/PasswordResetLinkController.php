<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Determine if the input is an email or username
        $input_type = filter_var($request->input('input_type'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
        // Merge the validated input into the request
        $request->merge([$input_type => $request->input('input_type')]);

        // Validate the request based on whether it's an email or username
        $request->validate([
            'email' => ['required_without:username', 'email', 'exists:users,email'],
            'username' => ['required_without:email', 'string', 'exists:users,username'],
        ]);

        // Send the password reset link
        $status = Password::sendResetLink(
            $request->only($input_type)
        );

        // Return the appropriate response based on the result
        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only($input_type))
                    ->withErrors([$input_type => __($status)]);
    }
}
