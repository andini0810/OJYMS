<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FindjobsController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SkillController;
use App\Http\Middleware\CheckUserStatus;
use App\Http\Controllers\UserprofileController;
use App\Http\Controllers\Admin\DashboardUserController;

// Route resource untuk CRUD user
Route::resource('users', UserController::class);


Route::get('/', function () {
    return view('overview');
});

Route::get('/jobs', function () {
    return view('jobs');
});


Route::get('/about', function () {
    return view('about');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
});


Route::middleware(['web'])->group(function () {
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardUserController::class, 'dashboard'])->name('admin.dashboard'); // Menampilkan dashboard (termasuk daftar pengguna)
    
    Route::get('/admin/users/{id}/edit', [DashboardUserController::class, 'edit'])->name('admin.users.edit'); // Endpoint untuk mendapatkan data user (AJAX)
    Route::put('/admin/users/{id}', [DashboardUserController::class, 'update'])->name('admin.users.update'); // Endpoint untuk menyimpan data edit
    Route::delete('/admin/users/{id}', [DashboardUserController::class, 'destroy'])->name('admin.users.destroy'); // Endpoint untuk menghapus user
});

// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware('auth');

Route::middleware(['auth', CheckUserStatus::class])->group(function () {
    Route::get('/home', [HomeController::class, 'showHome'])->name('home');
    Route::get('/findjobs', [FindjobsController::class, 'showFindjobs'])->name('findjobs');
    Route::get('/jobscreate', [FindjobsController::class, 'createJobs'])->name('jobscreate');
    Route::post('/jobsapply', [FindjobsController::class, 'applyJob'])->name('jobs.apply'); // Tambahkan ini
    Route::post('/findjobs', [FindjobsController::class, 'storeJob'])->name('jobs.store');
    Route::get('/alumni/applications', [FindjobsController::class, 'showApplications'])->name('alumni.applications');
    Route::get('/events', [EventsController::class, 'showEvents'])->name('events');
    Route::get('/eventcreate', [EventsController::class, 'createEvent'])->name('eventcreate');
    Route::post('/events', [EventsController::class, 'storeEvent'])->name('events.store');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // New route for viewing CVs
    Route::get('/view-cv/{id}', [FindjobsController::class, 'viewCV'])->name('view.cv');
    // Route::get('/selectSkill', [FormController::class, 'showForm'])->name('form');

    //API ROUTE
});

Route::middleware(['auth'])->group(function () {
    Route::get('/form', [RegisterController::class, 'edit'])->name('form');
    Route::post('/form-update', [RegisterController::class, 'update'])->name('form.update');
    Route::get('/userprofile', [UserprofileController::class, 'showUserprofile'])->name('userprofile');
    Route::put('/userprofile', [UserprofileController::class, 'update'])->name('userprofile.update');
    Route::delete('/userprofile', [UserprofileController::class, 'destroy'])->name('userprofile.destroy');
    Route::get('/skills/{parentId}/children', [SkillController::class, 'getChildren']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

});

Route::get('/test', [UserController::class, 'test']);

Route::get('/test-storage', function() {
    $path = storage_path('app/public/test.txt');
    File::put($path, 'Hello World');
    return 'File uji dibuat. Cek di: ' . asset('storage/test.txt');
});

