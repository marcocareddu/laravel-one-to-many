<?php

use App\Http\Controllers\Guest\HomeController as GuestHomeController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\ProfileController;
use App\Models\Project;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Guest Route
Route::prefix('/')->name('guest.')->group(function () {
    Route::get('/', [GuestHomeController::class, 'index'])->name('home');
});

// Admin Route
Route::prefix('/admin')->middleware('auth', 'verified')->name('admin.')->group(function () {
    Route::get('/', [AdminHomeController::class, 'index'])->name('home');

    // Trash route
    Route::get('/projects/trash', [ProjectController::class, 'trash'])->name('projects.trash');

    // Restore Projects Route 
    Route::patch('/projects/{project}/restore', [ProjectController::class, 'restore'])->name('projects.restore');

    // Drop Projects Route 
    Route::delete('/projects/{project}/drop', [ProjectController::class, 'drop'])->name('projects.drop');

    // Admin Projects routes
    Route::resource('projects', ProjectController::class);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
