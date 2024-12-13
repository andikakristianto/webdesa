<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LayananAkteModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AKTEadminAPI extends Controller
{
    public function index()
    {
        $akte = LayananAkteModel::all();

        return DataTables::of($akte)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                if ($row->status === 'sending') {
                    return '<button onclick="acceptRecord(' . $row->id . ')" class="py-2 px-7 inline-flex items-center gap-x-2 text-base font-medium rounded-2xl border border-transparent bg-teal-500 text-white hover:bg-teal-600">Proses</button>';
                } else if($row->status === "pending") {
                    $editButton = '<button onclick="rejectRecord(' . $row->id . ')" class="py-2 px-7 inline-flex items-center gap-x-2 text-base font-medium rounded-2xl border border-transparent bg-red-500 text-white hover:bg-red-600">Tolak</button>';
                    $approveButton = '<button onclick="doneRecord(' . $row->id . ')" class="py-2 px-7 inline-flex items-center gap-x-2 text-base font-medium rounded-2xl border border-transparent bg-teal-500 text-white hover:bg-teal-600">Setujui</button>';
                    return $editButton . ' ' . $approveButton;
                } else if($row->status === "done") {
                    return '<button onclick="deleteRecord(' . $row->id . ')" class="py-2 px-7 inline-flex items-center gap-x-2 text-base font-medium rounded-2xl border border-transparent bg-red-500 text-white hover:bg-red-600">Delete</button>';
                }else {
                    return '-';
                }
            })
            ->make(true);
    }
}
