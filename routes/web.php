<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReviewController;


Route::get('/', function () {
    return view('welcome');
});


// Home route
Route::get('/', function () {
    return view('welcome'); // Replace 'welcome' with your desired home view
})->name('home');

// Authenticated routes
    Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'admin:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.users');
    Route::get('/admin/events', [AdminController::class, 'manageEvents'])->name('admin.events');
    Route::get('/admin/reports', [AdminController::class, 'viewReports'])->name('admin.reports');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::delete('/admin/events/{id}', [AdminController::class, 'deleteEvent'])->name('admin.events.delete');
    
    Route::get('/admin/categories', [AdminController::class, 'manageCategories'])->name('admin.categories');
    Route::post('/admin/categories', [AdminController::class, 'createCategory'])->name('admin.categories.store');
    Route::get('/admin/categories/edit/{id}', [AdminController::class, 'editCategoryForm'])->name('admin.categories.edit');
    Route::post('/admin/categories/edit/{id}', [AdminController::class, 'editCategory'])->name('admin.categories.update');
    Route::post('/admin/categories/delete/{id}', [AdminController::class, 'deleteCategory'])->name('admin.categories.delete');
});



Route::middleware(['auth', 'organizer'])->prefix('organizer')->name('organizer.')->group(function () {
    // Organizer Dashboard
    Route::get('/dashboard', [OrganizerController::class, 'dashboard'])->name('dashboard');

    // Event Management
    Route::get('/events', [OrganizerController::class, 'manageEvents'])->name('events');
    Route::get('/events/create', [OrganizerController::class, 'createEvent'])->name('events.create'); // Show create form
    Route::post('/events', [OrganizerController::class, 'storeEvent'])->name('events.store');       // Store event
    Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');  //show events
    Route::get('/events/{id}/edit', [OrganizerController::class, 'editEvent'])->name('events.edit'); // Edit form
    Route::put('/events/{id}', [OrganizerController::class, 'updateEvent'])->name('events.update'); // Update event
    Route::delete('/events/{id}', [OrganizerController::class, 'deleteEvent'])->name('events.delete'); // Delete event
});
Route::middleware(['auth', 'user:user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
   
   
});
Route::middleware(['auth'])->group(function () {
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
    Route::get('/events/search', [EventController::class, 'search'])->name('events.search');
    Route::get('/events/browse', [EventController::class, 'browse'])->name('events.browse');

   
});
Route::middleware(['auth'])->group(function () {
    Route::get('/bookings/payment/success', [BookingController::class, 'paymentSuccess'])->name('bookings.payment.success');
    Route::get('/bookings/payment/cancel', [BookingController::class, 'paymentCancel'])->name('bookings.payment.cancel');
    
    
});
//Booking routes
Route::middleware(['auth'])->group(function () {
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
});


// Review routes
Route::middleware(['auth'])->group(function () {
    Route::get('/events/{event}/review', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/events/{event}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});
// Logout Route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Authentication routes (Laravel default)
require __DIR__.'/auth.php';
