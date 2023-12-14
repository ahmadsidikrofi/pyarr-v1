<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanPiringController extends Controller
{
    public function pinjamPiring_store(Request $request)
    {
        $request["rent_date"] = Carbon::now()->toDateString();
        $request["return_date"] = Carbon::now()->addDays(5)->toDateString();
        try {
            DB::beginTransaction();
            PeminjamanModel::create($request->except('category'));
            DB::commit();

            $piringDipinjam = PeminjamanModel::where('user_id', $request->user_id)
                ->where('piring_catalogue_id', $request->piring_catalogue_id)->where('actual_return_date', $request->actual_return_date);
            $piringData = $piringDipinjam->first();
            $piringData->save();
            return redirect('/');
        } catch (\Throwable $throw) {
            DB::rollback();
            dd($throw);
        }
    }

    public function showStatusRiwayatPinjam()
    {
        $peminjamanPirings = PeminjamanModel::with(['user', 'piring_catalogue'])->get();
        // Menghitung total harga
        $totalHarga = $peminjamanPirings->reduce(function ($carry, $item) {
            return $carry + $item->piring_catalogue->harga_sewa;
        }, 0);

        return view('user.update-riwayat-pinjam', compact('peminjamanPirings', 'totalHarga'));

    }
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Tersedia,Sedang Dipinjam,Sudah Dikembalikan',
        ]);

        $peminjaman = PeminjamanModel::findOrFail($id);
        $peminjaman->status = $request->status;

        // Mengatur actual_return_date jika statusnya 'Sudah Dikembalikan'
        if ($request->status == 'Sudah Dikembalikan') {
            $peminjaman->actual_return_date = now();
        }

        $peminjaman->save();

        // Redirect kembali dengan pesan sukses
        return back()->with('success', 'Status berhasil diupdate.');
    }

    public function showRiwayatPinjam()
    {
        $peminjamanPirings = PeminjamanModel::with(['user', 'piring_catalogue'])->get();
        // Menghitung total harga
        $totalHarga = $peminjamanPirings->reduce(function ($carry, $item) {
            return $carry + $item->piring_catalogue->harga_sewa;
        }, 0);

        return view('user.riwayat-pinjam', compact('peminjamanPirings', 'totalHarga'));

    }
}
