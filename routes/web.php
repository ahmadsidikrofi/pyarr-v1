<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\dashboardAdminController;
use App\Http\Controllers\ProfileController;
use App\Models\AuthModel;
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

Route::get('/', function () {
    $allUsers = AuthModel::latest()->get();

    // Count the number of admin and non-admin accounts
    $adminCount = AuthModel::where('is_admin', true)->count();
    $nonAdminCount = AuthModel::where('is_admin', false)->count();

    return view('dashboard', compact('allUsers', 'adminCount', 'nonAdminCount'));
});

// Auth
Route::get('/register', [AuthController::class, "register_page"]);
Route::post('/register/store', [AuthController::class, "register_store"]);
Route::get('/login', [AuthController::class, "login_page"]);
Route::post('/login/store', [AuthController::class, "login_store"]);
Route::get('/logout', [AuthController::class, "logout"]);
Route::get('/lupa-password', [AuthController::class, "lupaPassword_page"]);
Route::put('/lupa-password/store', [AuthController::class, "lupaPassword_store"]);

// LISTUSER
Route::get('/ListUser', [dashboardAdminController::class, "ListUser"])->name('admin.listuser');

// Profile
Route::get('/profile', [ProfileController::class, "profilePage"]);
