<?php

namespace App\Http\Controllers;

use App\Models\AuthModel;
use App\Models\PeminjamanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function profilePage()
    {
        $userId = Auth::id();
        $peminjamanTerbaru = PeminjamanModel::with('piring_catalogue')
            ->where('user_id', $userId)
            ->latest()
            ->take(3)
            ->get();

        return view('user.profile', compact('peminjamanTerbaru'));
    }

    public function profileUpdate_store(Request $request)
    {
        $username = $request->input('username');
        $no_hp = $request->input('no_hp');
        $alamat = $request->input('alamat');
        DB::table('users')
            ->where('id', '=', Auth::user()->id)
            ->update([
                'username' => $username,
                'no_hp' => $no_hp,
                'alamat' => $alamat,
            ]);
        return redirect()->back()->with('updateProfile', "Profilemu berhasil di update");
    }

    public function profileUpdate_pic(Request $request, $id)
    {
        $this->validate($request, [
            'profile_pic' => 'required|mimes:jpg,jpeg,png,jfif',
        ]);

        $profile = AuthModel::find($id);
        $profile->update($request->except("_token", "updatePic"));
        if ($request->hasFile("profile_pic")) {
            $request->file("profile_pic")->move("assets/images/profile/", $request->file("profile_pic")->getClientOriginalName());
            $profile->profile_pic = $request->file("profile_pic")->getClientOriginalName();
            $profile->save();
        }
        return redirect()->back()->with('profileUpdate', 'Profile Kamu Sukses Di Update');
    }
}
