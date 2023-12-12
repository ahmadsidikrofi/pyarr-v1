<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanPiringController extends Controller
{
    function pinjamPiring_store( Request $request )
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

    public function riwayatPinjam_page()
    {

    }
}
