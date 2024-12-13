<?php

namespace App\Http\Controllers\API\Berita;

use App\Http\Controllers\Controller;
use App\Models\ArticleModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BeritaAPI extends Controller
{
    public function index()
    {
        // Load data artikel beserta kategori
        $article = ArticleModel::with('category')->get();

        return DataTables::of($article)
            ->addIndexColumn()
            ->addColumn('category_name', function ($article) {
                return $article->category ? $article->category->name : 'Tidak ada kategori';
            })
            ->addColumn('action', function ($article) {
                $editUrl = route('berita.edit', ['id' => $article->id]);
                $editButton = '<a href="' . $editUrl . '" class="btn py-2 px-4">Edit</a>';
                $deleteButton = '<button class="btn py-2 px-4 bg-red-500" onclick="deleteBerita(' . $article->id . ')">Delete</button>';
                return $editButton . ' ' . $deleteButton;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
