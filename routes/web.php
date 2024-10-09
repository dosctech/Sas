<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Home route


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/admin/requests', [AdminController::class, 'requests'])->name('admin.adminreq');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/request/{id}', [AdminController::class, 'viewRequest'])->name('admin.view-request');
    Route::get('/admin/requests/edit/{id}', [AdminController::class, 'edit'])->name('edit-request');
    Route::post('/admin/requests/update/{id}', [AdminController::class, 'update'])->name('update-request');
});

Route::delete('/request/{id}', [AdminController::class, 'destroy'])->name('delete-request');

Route::get('/request/read/{id}', [RequestController::class, 'read'])->name('read');


Route::post('/request/accept/{id}', [RequestController::class, 'accept'])->name('accept-request');
Route::post('/request/reject/{id}', [RequestController::class, 'reject'])->name('reject-request');

Route::middleware(['auth'])->group(function () {
    Route::get('/requests', [RequestController::class, 'index'])->name('all-requests');
   
    Route::post('/request/submit', [RequestController::class, 'submitForm'])->name('submit-request');
});

// Request routes
Route::get('/request', [RequestController::class, 'showForm'])->name('request');
Route::post('/submit-request', [RequestController::class, 'submitForm'])->name('submit-request');
Route::get('/read', [RequestController::class, 'read'])->name('read');
Route::get('/request/edit/{id}', [AdminController::class, 'edit'])->name('edit-request');
Route::post('/request/update/{id}', [AdminController::class, 'update'])->name('update-request');
Route::get('/homeuser', [RequestController::class, 'showForm'])->name('homeuser');


// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
