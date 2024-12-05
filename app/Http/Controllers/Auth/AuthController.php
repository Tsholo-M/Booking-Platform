<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Logout Method
    public function logout(Request $request)
    {
        Auth::logout(); // Log out the user

        // Invalidate the user's session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the login page
        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }
}
