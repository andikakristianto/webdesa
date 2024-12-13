<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LayananAkteModel;
use Illuminate\Http\Request;

class AkteManagementController extends Controller
{
    public function index()
    {
        return view("dashboard.admin.layanan.akte");
    }


    public function pending($id)
    {
        $akte = LayananAkteModel::find($id);

        if ($akte) {
            $akte->status = 'pending';
            $akte->save();

            return response()->json([
                'message' => 'Status berhasil diubah menjadi pending',
                'data' => $akte,
            ], 200);
        }

        return response()->json([
            'message' => 'Data tidak ditemukan',
        ], 404);
    }

    public function done($id)
    {
        $akte = LayananAkteModel::find($id);

        if ($akte) {
            $akte->status = 'done';
            $akte->message = 'Disetujui';
            $akte->save();

            return response()->json([
                'message' => 'Status berhasil diupdate',
                'data' => $akte,
            ], 200);
        }

        return response()->json([
            'message' => 'Data tidak ditemukan',
        ], 404);
    }


    public function reject($id)
    {
        $akte = LayananAkteModel::find($id);

        if ($akte) {
            $akte->status = 'rejected';
            $akte->message = null;
            $akte->save();

            return response()->json([
                'message' => 'Status berhasil diupdate',
                'data' => $akte,
            ], 200);
        }

        return response()->json([
            'message' => 'Data tidak ditemukan',
        ], 404);
    }
}
