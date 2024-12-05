<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Category;
use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Admin Dashboard
    public function index()
    {
        $user = Auth::user(); // Retrieve the authenticated user

        // Ensure the user is an admin
        if ($user && $user->role === 'admin') {
            // Get dashboard data
            $totalUsers = User::count();
            $totalEvents = Event::count();
            $totalBookings = Booking::count();
            $totalRevenue = Payment::sum('amount');

            return view('admin.dashboard', compact('totalUsers', 'totalEvents', 'totalBookings', 'totalRevenue'));
        }

        return redirect()->route('home')->with('error', 'Unauthorized Access!');
    }

    // Manage Users
    public function manageUsers()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    // Edit User (Admin can edit roles, etc.)
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit-user', compact('user'));
    }

    // Update User
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Admin can change the role or update user details
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,organizer,user', // Adjust according to your roles
        ]);

        $user->update($request->all());

        return redirect()->route('admin.users')->with('success', 'User updated successfully!');
    }

    // Delete User
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        // Ensure that an admin cannot delete themselves
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users')->with('error', 'You cannot delete your own account!');
        }

        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully!');
    }

    // Manage Events
    public function manageEvents()
    {
        $events = Event::with('organizer', 'category')->get();
        return view('admin.events', compact('events'));
    }

    // Change Event Status (Active/Inactive, etc.)
    public function changeEventStatus($id, $status)
    {
        $event = Event::findOrFail($id);

        $event->status = $status;
        $event->save();

        return redirect()->route('admin.events')->with('success', 'Event status updated successfully!');
    }

    // Delete Event
    public function deleteEvent($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('admin.events')->with('success', 'Event deleted successfully!');
    }

    // Manage Categories
    public function manageCategories()
    {
        $categories = Category::all();
        return view('admin.categories', compact('categories'));
    }

    // Create Category
    public function createCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
        ]);

        Category::create($request->all());

        return redirect()->route('admin.categories')->with('success', 'Category created successfully!');
    }

    // Edit Category
    public function editCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'description' => 'nullable|string',
        ]);

        $category->update($request->all());

        return redirect()->route('admin.categories')->with('success', 'Category updated successfully!');
    }

    // Delete Category
    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully!');
    }
    public function editCategoryForm($id)
{
    $category = Category::findOrFail($id);
    return view('admin.edit-category', compact('category'));
}


    // View Reports (Revenue, Bookings)
    public function viewReports()
    {
        $monthlyRevenue = Payment::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->groupBy('month')
            ->get();

        $monthlyBookings = Booking::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->get();

        return view('admin.reports', compact('monthlyRevenue', 'monthlyBookings'));
    }
}
