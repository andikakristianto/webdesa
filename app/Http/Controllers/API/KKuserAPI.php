<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LayananKKModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class KKuserAPI extends Controller
{
    public function index(Request $request)
    {
        $kk = LayananKKModel::where('user_id', Auth::user()->id)->get();

        return DataTables::of($kk)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                if($row->status === "rejected"){
                    $editUrl = route("layanankk.update", [$row->id]);
                    return '<a href="'. $editUrl .'" class="btn btn-sm btn-info">Edit</a>';
                }else{
                    return "-";
                }
            })
            ->make(true);
    }
}
