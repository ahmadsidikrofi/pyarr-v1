<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;

class CategoryController extends Controller
{
    function categoryPage()
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
        return redirect('/show-category');
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
        return redirect('/show-category');
    }

    public function delete_store($slug)
    {
        CategoryModel::where('slug', $slug)->first()->delete();
        return redirect()->back();
    }
}
