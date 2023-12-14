<?php

namespace App\Http\Controllers;

use App\Models\PiringModel;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use Intervention\Image\Image;
use App\Models\PeminjamanModel;
use Illuminate\Support\Facades\Auth;

class PiringController extends Controller
{
    public function createPiring_page()
    {
        $categories = CategoryModel::all();
        return view('piringCatalogue.createPiring', compact(["categories"]));
    }

    public function createPiring_store( Request $request )
    {
        $piringBaru = PiringModel::create($request->except('category'));
        $piringBaru->categories()->sync($request->category);

        $piringCatalogueId = PiringModel::where('piring_catalogue_id', $request->piring_catalogue_id);
        $piringData = $piringCatalogueId->first();
        $piringID = $piringData->id;
        $piringData->piring_catalogue_id = $piringID;
        if ($piringData) {
            $piringData->save();
        } else {
            dd("data tidak ditemukan");
        }

        if ( $request -> hasFile("image") ) {
            $request -> file("image")->move("assets/images/", $request->file("image")->getClientOriginalName());
            $piringBaru -> image = $request -> file("image")->getClientOriginalName();
            $piringBaru -> save();
        }
        return redirect()->back();
    }

    public function editPiring_page($slug)
    {
        $editPiring = PiringModel::where('slug', $slug)->first();
        $categories = CategoryModel::all();
        return view('piringCatalogue.editPiring', compact(['editPiring', 'categories']));
    }

    public function editPiring_store(Request $request, $slug)
    {
        $editPiring = PiringModel::where('slug', $slug)->first();
        $editPiring->update($request->except("category"));

        if ( $request -> hasFile("image") ) {
            $request -> file("image")->move("assets/images/", $request->file("image")->getClientOriginalName());
            $editPiring -> image = $request -> file("image")->getClientOriginalName();
            $editPiring -> save();
        }
        return redirect('/');
    }

    public function deletePiring($slug)
    {
        PiringModel::where('slug', $slug)->first()->delete();
        return redirect()->back();
    }

    // Detail Piring (user/ member)
    public function detailPiring_page($slug)
    {
        $userId = Auth::id();
        $detailPiring = PiringModel::where('slug', $slug)->first();
        $categories = CategoryModel::all();
        $totalPinjam = PeminjamanModel::where('user_id', $userId)
        ->where(function ($query) {
            $query->where('status', 'Sedang Dipinjam')
                ->orWhere('status', 'Tersedia');
        })
        ->count();
        return view('piringCatalogue.detailPiring', compact(['detailPiring', 'categories', 'totalPinjam']));
    }
}
