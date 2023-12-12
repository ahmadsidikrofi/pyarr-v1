<?php

use App\Models\AuthModel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;

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
    return view('dashboard', compact(["allUsers"]));
})->middleware('auth');


// Auth
Route::get('/register', [AuthController::class, "register_page"]);
Route::post('/register/store', [AuthController::class, "register_store"]);
Route::get('/login', [AuthController::class, "login_page"])->name('login');
Route::post('/login/store', [AuthController::class, "login_store"]);
Route::get('/logout', [AuthController::class, "logout"]);
Route::get('/lupa-password', [AuthController::class, "lupaPassword_page"]);
Route::put('/lupa-password/store', [AuthController::class, "lupaPassword_store"]);

// Profile
Route::get('/profile', [ProfileController::class, "profilePage"])->middleware('auth');
Route::put('/profile/update', [ProfileController::class, "profileUpdate_store"]);
Route::post('/profile/{id}/profile-picture', [ProfileController::class, "profileUpdate_pic"]);


// Kategori
Route::get('/show-category', [CategoryController::class, "categoryPage"]);
Route::get('/tambah-kategori', [CategoryController::class, "createCategoriPage"]);
Route::post('/tambah-kategori/store', [CategoryController::class, "createCategoriPage_store"]);
Route::get('/delete/kategori/{slug}', [CategoryController::class, "delete_store"]);
Route::get('/edit-kategori/{slug}', [CategoryController::class, "edit_page"]);
Route::put('/edit-kategori/{slug}/store', [CategoryController::class, "editPage_store"]);
