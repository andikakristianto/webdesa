<?php

namespace App\Http\Controllers;

use App\Models\LayananKTPModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LayananKTPController extends Controller
{
    public function index()
    {
        return view("dashboard.users.ktp");
    }

    public function store(Request $request)
    {
        $validate = $request->validate(
            [
            "namalengkap" => "required",
            "nik" => "required|min:16",
            "kewarganegaraan" => "required",
            "jeniskelamin" => "required",
            "tempatlahir" => "required",
            "tanggallahir" => "required",
            "agama" => "required",
            "alamat" => "required",
            "pekerjaan" => "required",
            "statuskawin" => "required",
            "files" => "required|file",
            "status" => "required",
            ],
            [
            "namalengkap.required" => "Masukan Nama Lengkap Terlebih Dahulu",
            "nik.required" => "Masukan NIK Terlebih Dahulu",
            "nik.min" => "Minimal 16 Digits",
            "kewarganegaraan.required" => "Masukan Kewarganegaraan Anda Terlebih Dahulu",
            "jeniskelamin.required" => "Masukan Jenis Kelamin Anda",
            "tempatlahir.required" => "Masukan Tempat Lahir",
            "tanggallahir.required" => "Masukan Tanggal Lahir",
            "agama.required" => "Agama",
            "alamat.required" => "Masukan Alamat Anda",
            "pekerjaan.required" => "Masukan Pekerjaan Anda",
            "statuskawin.required" => "Status Kawin",
            "files.required" => "File Wajib DIupload",
            ]);

            $validate["user_id"] = Auth::user()->id;
            $validate["status"] = "sending";

            if ($request->hasFile('files')) {
                $file = $request->file('files');
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('files/kk', $filename, 'public');
                $validate['files'] = $filePath;
            }

            LayananKTPModel::create($validate);

            return redirect()->route("dashboard");
    }


    public function update($id)
    {
        $ktp = LayananKTPModel::find($id);
        return view("dashboard.users.ktpedit", compact("ktp"));
    }

    public function updatestore(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                "namalengkap" => "required",
                "nik" => "required|min:16",
                "kewarganegaraan" => "required",
                "jeniskelamin" => "required",
                "tempatlahir" => "required",
                "tanggallahir" => "required",
                "agama" => "required",
                "alamat" => "required",
                "pekerjaan" => "required",
                "statuskawin" => "required",
                "files" => "nullable|file",
                "status" => "required",
                ],
                [
                "namalengkap.required" => "Masukan Nama Lengkap Terlebih Dahulu",
                "nik.required" => "Masukan NIK Terlebih Dahulu",
                "nik.min" => "Minimal 16 Digits",
                "kewarganegaraan.required" => "Masukan Kewarganegaraan Anda Terlebih Dahulu",
                "jeniskelamin.required" => "Masukan Jenis Kelamin Anda",
                "tempatlahir.required" => "Masukan Tempat Lahir",
                "tanggallahir.required" => "Masukan Tanggal Lahir",
                "agama.required" => "Agama",
                "alamat.required" => "Masukan Alamat Anda",
                "pekerjaan.required" => "Masukan Pekerjaan Anda",
                "statuskawin.required" => "Status Kawin",
                ],
        );

        $validatedData["status"] = "sending";
        $layananKTP = LayananKTPModel::findOrFail($id);

        if ($request->hasFile('files')) {
            if ($layananKTP->files && \Storage::disk('public')->exists($layananKTP->files)) {
                \Storage::disk('public')->delete($layananKTP->files);
            }

            $file = $request->file('files');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('files/ktp', $filename, 'public');
            $validatedData['files'] = $filePath;
        }

        $layananKTP->update($validatedData);

        return redirect()->route('dashboard')->with('success', 'Data berhasil diperbarui.');
    }

    public function message($id)
    {
        $id = LayananKTPModel::findOrFail($id);
        return view("dashboard.admin.layanan.ktp.message", compact("id"));
    }

    public function postmessage(Request $request,$id)
    {
        $ktp = LayananKTPModel::find($id);

        $ktp->message = $request->message;
        $ktp->save();

        return redirect()->route("managementktp.index");
    }

    public function destroy($id)
    {
        $layananKTP = LayananKTPModel::find($id);

        if (!$layananKTP) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan.'
            ], 404);
        }

        if ($layananKTP->files && Storage::disk('public')->exists($layananKTP->files)) {
            Storage::disk('public')->delete($layananKTP->files);
        }


        $layananKTP->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus.'
        ]);
    }

}
