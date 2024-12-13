<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LayananKKModel;
use Illuminate\Http\Request;

class KKManagementController extends Controller
{
    public function index()
    {
        return view("dashboard.admin.layanan.kk");
    }


    public function pending($id)
    {
        $kk = LayananKKModel::find($id);

        if ($kk) {
            $kk->status = 'pending';
            $kk->save();

            return response()->json([
                'message' => 'Status berhasil diubah menjadi pending',
                'data' => $kk,
            ], 200);
        }

        return response()->json([
            'message' => 'Data tidak ditemukan',
        ], 404);
    }

    public function done($id)
    {
        $kk = LayananKKModel::find($id);

        if ($kk) {
            $kk->status = 'done';
            $kk->message = 'Disetujui';
            $kk->save();

            return response()->json([
                'message' => 'Status berhasil diupdate',
                'data' => $kk,
            ], 200);
        }

        return response()->json([
            'message' => 'Data tidak ditemukan',
        ], 404);
    }


    public function reject($id)
    {
        $kk = LayananKKModel::find($id);

        if ($kk) {
            $kk->status = 'rejected';
            $kk->message = null;
            $kk->save();

            return response()->json([
                'message' => 'Status berhasil diupdate',
                'data' => $kk,
            ], 200);
        }

        return response()->json([
            'message' => 'Data tidak ditemukan',
        ], 404);
    }
}
