<?php

use App\Models\AuthModel;
use App\Models\PiringModel;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\PeminjamanModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PiringController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\dashboardAdminController;
use App\Http\Controllers\PeminjamanPiringController;

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

Route::get('/', function (Request $request) {
    $userId = Auth::id();
    $allUsers = AuthModel::latest()->get();
    $adminCount = AuthModel::where('is_admin', true)->count();
    $nonAdminCount = AuthModel::where('is_admin', false)->count();
    $totalPiring = PiringModel::count();
    $totalKategori = CategoryModel::count();
    $allPiring = PiringModel::latest()->filter(['search' => $request->search])->paginate(10);

    $totalPinjam = PeminjamanModel::where('user_id', $userId)
    ->where(function ($query) {
        $query->where('status', 'Sedang Dipinjam')
            ->orWhere('status', 'Tersedia');
    })->count();

    return view('dashboard', compact([
        'allUsers', 'adminCount', 'nonAdminCount',
        'allPiring', 'totalPiring', 'totalKategori', 'totalPinjam'
    ]));
})->middleware('auth');

// Auth
Route::get('/register', [AuthController::class, "register_page"]);
Route::post('/register/store', [AuthController::class, "register_store"]);
Route::get('/login', [AuthController::class, "login_page"])->name('login');
Route::post('/login/store', [AuthController::class, "login_store"]);
Route::get('/logout', [AuthController::class, "logout"]);
Route::get('/lupa-password', [AuthController::class, "lupaPassword_page"]);
Route::put('/lupa-password/store', [AuthController::class, "lupaPassword_store"]);

Route::delete('/delete-user/{id}', [AuthController::class, 'destroy']);

// LISTUSER
Route::get('/ListUser', [dashboardAdminController::class, "ListUser"])->name('admin.listuser');
Route::get('/tambah-user', [dashboardAdminController::class, "tampilan_tambah_user"]);
Route::post('/tambah-user', [dashboardAdminController::class, 'store'])->name('dashboard.admin.store');
Route::get('/edit-user/{id}', [dashboardAdminController::class, 'edit'])->name('user.edit');
Route::put('/update-user/{id}', [DashboardAdminController::class, 'update'])->name('user.update');

// Profile
Route::get('/profile', [ProfileController::class, "profilePage"])->middleware('auth');
Route::put('/profile/update', [ProfileController::class, "profileUpdate_store"]);
Route::post('/profile/{id}/profile-picture', [ProfileController::class, "profileUpdate_pic"]);
Route::get('/profile-pic/{id}/delete', [ProfileController::class, "profileDelete_pic"]);

// Kategori
Route::get('/show-category', [CategoryController::class, "categoryPage"]);
Route::get('/tambah-kategori', [CategoryController::class, "createCategoriPage"]);
Route::post('/tambah-kategori/store', [CategoryController::class, "createCategoriPage_store"]);
Route::get('/delete/kategori/{slug}', [CategoryController::class, "delete_store"]);
Route::get('/edit-kategori/{slug}', [CategoryController::class, "edit_page"]);
Route::put('/edit-kategori/{slug}/store', [CategoryController::class, "editPage_store"]);

// Piring
Route::get('/tambah-piring', [PiringController::class, "createPiring_page"]);
Route::post('/tambah-piring/store', [PiringController::class, "createPiring_store"]);
Route::get('/edit-piring/{slug}', [PiringController::class, "editPiring_page"]);
Route::put('/edit-piring/{slug}/store', [PiringController::class, "editPiring_store"]);
Route::get('/delete-piring/{slug}', [PiringController::class, "deletePiring"]);

// Detail Piring
Route::get('/detail-piring/{slug}', [PiringController::class, "detailPiring_page"]);
// Peminjaman Piring
Route::post('/pinjam-piring/{slug}', [PeminjamanPiringController::class, "pinjamPiring_store"]);
Route::get('/riwayat-pinjam', [PeminjamanPiringController::class, "showRiwayatPinjam"]);
Route::get('/piring-terpinjam', [PeminjamanPiringController::class, "showRiwayatPinjamUser"]);
Route::put('/kembalikan-piring/{id}', [PeminjamanPiringController::class, "kembalikanPiringUser"]);
// routes/web.php
Route::get('/update-status-riwayat-pinjam', [PeminjamanPiringController::class, "showStatusRiwayatPinjam"]);
Route::post('/update-status-peminjaman/{id}', [PeminjamanPiringController::class, 'updateStatus']);
