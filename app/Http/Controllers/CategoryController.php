<?php

namespace App\Http\Controllers;

use App\Models\CategoriesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    public function index()
    {
        return view("dashboard.admin.berita.category.index");
    }



    public function tambahview()
    {
        return view("dashboard.admin.berita.category.tambah");
    }

    public function store(Request $request)
    {
        CategoriesModel::create([
            "name" => $request->name,
            "slug" => Str::slug($request->name),

        ]);

        return redirect()->route("category.index");
    }


    public function edit($id)
    {
        $category = CategoriesModel::findOrFail($id);

        return view("dashboard.admin.berita.category.edit", compact("category"));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = CategoriesModel::findOrFail($id);

        $category->update([
            "name" => $request->name,
            "slug" => Str::slug($request->name),
        ]);

        return redirect()->route("category.index")->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy($id)
    {
        $category = CategoriesModel::findOrFail($id);
        $category->delete();

        return redirect()->route("category.index")->with('success', 'Kategori berhasil dihapus');
    }
}
