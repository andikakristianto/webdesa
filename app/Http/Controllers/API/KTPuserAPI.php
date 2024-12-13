<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LayananKTPModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class KTPuserAPI extends Controller
{
    public function index()
    {
        $kk = LayananKTPModel::where('user_id', Auth::user()->id)->get();

        return DataTables::of($kk)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                if($row->status === "rejected"){
                    $editUrl = route("layananktp.update", [$row->id]);
                    return '<a href="'. $editUrl .'" class="btn btn-sm btn-info">Edit</a>';
                }else{
                    return "-";
                }
            })
            ->make(true);
    }
}
