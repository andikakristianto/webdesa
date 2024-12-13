<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LayananAkteModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AKTEuserAPI extends Controller
{
    public function index()
    {
        $akte = LayananAkteModel::where('user_id', Auth::user()->id)->get();

        return DataTables::of($akte)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                if($row->status === "rejected"){
                    $editUrl = route("layananakte.update", [$row->id]);
                    return '<a href="'. $editUrl .'" class="btn btn-sm btn-info">Edit</a>';
                }else{
                    return "-";
                }
            })
            ->make(true);
    }
}
