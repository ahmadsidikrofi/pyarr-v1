<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;

class CategoryController extends Controller
{
    public function categoryPage()
    {
        $kategoris = CategoryModel::latest()->get();
        return view('category.categoryPage', compact(['kategoris']));
    }

    public function createCategoriPage()
    {
        return view('category.createCategory');
    }

    public function createCategoriPage_store(Request $request)
    {
        CategoryModel::create($request->all());
        $categoryPiring = CategoryModel::where('category_id', $request->category_id);

        $categoryData = $categoryPiring->first();
        $categoryID = $categoryData->id;
        $categoryData->category_id = $categoryID;

        if ($categoryData) {
            $categoryData->save();
        } else {
            dd("data tidak ditemukan");
        }
        return redirect()->back()->with("tambahKategori", "Kategori berhasil ditambahkan");
    }

    public function edit_page($slug)
    {
        $editKategori = CategoryModel::where('slug', $slug)->first();
        return view('category.editCategory', compact(['editKategori']));
    }
    public function editPage_store($slug, Request $request)
    {
        $editKategori = CategoryModel::where('slug', $slug)->first();
        $editKategori->update($request->all());

        return redirect('/show-category')->with("updateKategori", "Kategori berhasil diubah");
    }

    public function delete_store($slug)
    {
        CategoryModel::where('slug', $slug)->first()->delete();
        return redirect()->back()->with("hapusKategori", "Kategori berhasil dihapus");
    }
}
