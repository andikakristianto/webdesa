<?php

namespace App\Http\Controllers;

use App\Models\ArticleModel;
use App\Models\CategoriesModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        return view("dashboard.admin.berita.index");
    }

    public function create()
    {
        $categories = CategoriesModel::all();
        return view("dashboard.admin.berita.tambah", compact("categories"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'published_at' => 'nullable|date',
            'status' => 'required|in:draft,published',
        ]);

        $slug = Str::slug($request->title);

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnail', 'public');
        } else {
            $thumbnailPath = null;
        }

        ArticleModel::create([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'thumbnail' => $thumbnailPath,
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'published_at' => $request->published_at,
            'status' => $request->status,
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $berita = ArticleModel::findOrFail($id);
        $berita->published_at = Carbon::parse($berita->published_at)->format('Y-m-d');

        $categories = CategoriesModel::all();
        return view('dashboard.admin.berita.edit', compact('berita', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:published,draft',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $berita = ArticleModel::findOrFail($id);

        $berita->title = $request->input('title');
        $berita->category_id = $request->input('category_id');
        $berita->status = $request->input('status');


        if ($request->hasFile('thumbnail')) {
            if ($berita->thumbnail && Storage::exists($berita->thumbnail)) {
                Storage::delete($berita->thumbnail);
            }


            $thumbnailPath = $request->file('thumbnail')->store('thumbnail', 'public');
            $berita->thumbnail = $thumbnailPath;
        }

        $berita->save();

        return redirect()->route('berita.index')->with('success', 'Berita updated successfully!');
    }

    public function destroy($id)
    {
        $berita = ArticleModel::findOrFail($id);

        if ($berita->thumbnail && Storage::exists($berita->thumbnail)) {
            Storage::delete($berita->thumbnail);
        }

        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus!');
    }

}
