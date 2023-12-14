<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class dashboardAdminController extends Controller
{
    //
    public function ListUser()
    {
        $allUsers = User::all();
        return view('user.list-user', compact('allUsers'));
    }

    public function tampilan_tambah_user()
    {
        return view('user.tambah-user');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'username' => 'required',
            'password' => 'required|min:6',
            // Tambahkan aturan validasi lainnya sesuai kebutuhan
        ]);

        // Membuat user baru
        $user = new User([
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password), // Meng-hash password
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'gender' => $request->gender,
            // 'profile_pic' => $request->profile_pic, // Menghandle upload file jika diperlukan
            'is_admin' => $request->is_admin, // Penetapan apakah user adalah admin
        ]);

        // Simpan user ke database
        $user->save();

        // Redirect ke halaman yang diinginkan dengan pesan sukses
        return redirect()->route('admin.listuser')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); // Mengambil user berdasarkan ID atau gagal jika tidak ditemukan

        return view('user.edit', compact('user')); // Mengirimkan user ke view
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users,email,' . $id, // Excluding the current user from unique check
            'alamat' => 'nullable',
            'no_hp' => 'nullable',
            'gender' => 'required|in:Pria,Wanita',
            'is_admin' => 'required|boolean',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'gender' => $request->gender,
            'is_admin' => $request->is_admin,
        ]);

        // Redirect ke halaman yang diinginkan dengan pesan sukses
        return redirect()->route('admin.listuser')->with('success', 'User berhasil diupdate.');
    }
}
