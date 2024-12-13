<?php

namespace App\Http\Controllers;

use App\Models\LayananKKModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LayananKKController extends Controller
{
    public function index()
    {
        return view("dashboard.users.kk");
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'namalengkap' => 'required',
            'nik' => 'nullable',
            'jeniskelamin' => 'required|in:laki,perempuan',
            'kepalakeluarga' => 'required',
            'tanggallahir' => 'required',
            'tempatlahir' => 'required',
            'alamat' => 'required',
            'files' => 'required|file',
            "status" => "required",
        ],[
            'namalengkap.required' => 'Nama lengkap wajib diisi.',
            'namalengkap.string' => 'Nama lengkap harus berupa teks.',
            'nik.numeric' => 'NIK harus berupa angka.',
            'nik.digits' => 'NIK harus terdiri dari 16 digit.',
            'jeniskelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jeniskelamin.in' => 'Jenis kelamin tidak valid.',
            'kepalakeluarga.required' => 'Nama kepala keluarga wajib diisi.',
            'tanggallahir.required' => 'Tanggal lahir wajib diisi.',
            'tempatlahir.required' => 'Tempat lahir wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'files.required' => 'Dokumen wajib diunggah.',
        ]);



        $validatedData['user_id'] = Auth::user()->id;

        if ($request->hasFile('files')) {
            $file = $request->file('files');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('files/kk', $filename, 'public');
            $validatedData['files'] = $filePath;
        }

        LayananKKModel::create($validatedData);

        return redirect()->route("dashboard")->with('success', 'Data berhasil disimpan.');
    }

    public function update($id)
    {
        $kk = LayananKKModel::find($id);
        return view("dashboard.users.kkedit", compact("kk"));
    }

    public function updatestore(Request $request, $id)
    {
        $validatedData = $request->validate([
            'namalengkap' => 'required|string',
            'nik' => 'nullable|min:16',
            'jeniskelamin' => 'required|in:laki,perempuan',
            'kepalakeluarga' => 'required|string',
            'tanggallahir' => 'required|date',
            'tempatlahir' => 'required|string',
            'alamat' => 'required|string',
            'files' => 'nullable|file',
        ], [
            'namalengkap.required' => 'Nama lengkap wajib diisi.',
            'namalengkap.string' => 'Nama lengkap harus berupa teks.',
            'nik.numeric' => 'NIK harus berupa angka.',
            'nik.digits' => 'NIK harus terdiri dari 16 digit.',
            'jeniskelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jeniskelamin.in' => 'Jenis kelamin tidak valid.',
            'kepalakeluarga.required' => 'Nama kepala keluarga wajib diisi.',
            'tanggallahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggallahir.date' => 'Tanggal lahir tidak valid.',
            'tempatlahir.required' => 'Tempat lahir wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'files.file' => 'Dokumen harus berupa file.',
        ]);

        $validatedData["status"] = "sending";
        $layananKK = LayananKKModel::findOrFail($id);

        if ($request->hasFile('files')) {
            if ($layananKK->files && \Storage::disk('public')->exists($layananKK->files)) {
                \Storage::disk('public')->delete($layananKK->files);
            }

            $file = $request->file('files');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('files/kk', $filename, 'public');
            $validatedData['files'] = $filePath;
        }

        $layananKK->update($validatedData);

        return redirect()->route('dashboard')->with('success', 'Data berhasil diperbarui.');
    }


    public function message($id)
    {
        $id = LayananKKModel::findOrFail($id);
        return view("dashboard.admin.layanan.kk.message", compact("id"));
    }

    public function postmessage(Request $request,$id)
    {
        $kk = LayananKKModel::find($id);

        $kk->message = $request->message;
        $kk->save();

        return redirect()->route("managementkk.index");
    }


    public function destroy($id)
    {
        $layananKK = LayananKKModel::find($id);

        if (!$layananKK) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan.'
            ], 404);
        }

        if ($layananKK->files && Storage::disk('public')->exists($layananKK->files)) {
            Storage::disk('public')->delete($layananKK->files);
        }


        $layananKK->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus.'
        ]);
    }
}
