<?php

namespace App\Http\Controllers;

use App\Models\ArticleModel;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(){

        $berita = ArticleModel::where("status", "published")->get();
        return view("landing_page", compact("berita"));
    }

    public function berita($slug)
{
    $berita = ArticleModel::where('slug', $slug)->firstOrFail();
    return view('berita', compact('berita'));
}
}
