<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View  // No argument needed here
    {
        return view('auth.register');  // Ensure the 'auth.register' view exists
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the registration request
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:admin,organizer,user'],
        ]);

        // Create the new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // Assign the role here
        ]);
       



        // Fire the Registered event and log the user in
        event(new Registered($user));
        Auth::login($user);

        // Redirect to the dashboard or wherever necessary
       // return redirect(route('dashboard', absolute: false));
       if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');  // Redirect to admin dashboard
    }

    if ($user->role === 'organizer') {
        return redirect()->route('organizer.dashboard');  // Redirect to organizer dashboard
    }

    return redirect()->route('user.dashboard');  // Redirect to user dashboard
    }
}
