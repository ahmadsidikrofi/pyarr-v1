<?php

namespace App\Http\Controllers;

use App\Models\AuthModel;
use App\Models\PeminjamanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function profilePage()
    {
        $userId = Auth::id();
        $peminjamanTerbaru = PeminjamanModel::with('piring_catalogue', 'user')
            ->where('user_id', $userId)
            ->whereIn('status', ['Sedang Dipinjam', 'Sudah Dikembalikan', 'Siap Dikembalikan'])
            ->latest()
            ->take(3)
            ->get();
        $countTersedia = PeminjamanModel::with('piring_catalogue')
        ->where('user_id', $userId)
        ->where('status', 'Tersedia')
        ->count();
        $statusTersedia = PeminjamanModel::with('piring_catalogue')->where('user_id', $userId)->get();
        return view('user.profile', compact(['peminjamanTerbaru', 'statusTersedia', 'countTersedia']));
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

    public function profileDelete_pic($id)
    {
        $user = AuthModel::find($id);
        $img_path = public_path().'/assets/images/profile/'.$user->image;

        if (File::exists($img_path)) {
            File::delete($img_path);

            $user->update([
                'profile_pic' => null,
            ]);
        }
        return redirect()->back()->with("profilePicDelete", "Foto Profile dihapus");

    }
}
