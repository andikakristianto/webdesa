<?php

namespace App\Http\Controllers\API\Berita;

use App\Http\Controllers\Controller;
use App\Models\CategoriesModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryAPI extends Controller
{
    public function index()
    {
        $category = CategoriesModel::get();

        return DataTables::of($category)
        ->addIndexColumn()
        ->addColumn('action', function ($category) {
             $editUrl = route('category.edit', ['id' => $category->id]);
             $editButton = '<a  href="' . $editUrl . '" class="btn py-2 px-4" >Edit</a>';
             $deleteButton = '<button class="btn py-2 px-4 bg-red-500" onclick="deleteCategory(' . $category->id . ')">Delete</button>';
             return $editButton . ' ' . $deleteButton;
        })
        ->make(true);
    }
}
