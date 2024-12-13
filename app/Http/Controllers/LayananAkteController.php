<?php

namespace App\Http\Controllers;

use App\Models\LayananAkteModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LayananAkteController extends Controller
{
    public function index()
    {
        return view("dashboard.users.akte");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:255',
            'kk' => 'nullable',
            'nik' => 'nullable|min:16',
            'jeniskelamin' => 'required',
            'tempatlahir' => 'required',
            'agama' => 'required',
            'tanggallahir' => 'required',
            'files' => 'required|file',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'kk.required' => 'Nomor KK harus diisi',
            'nik.required' => 'NIK harus berisi 16 min',
            'jeniskelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jeniskelamin.in' => 'Jenis kelamin yang dipilih tidak valid.',
            'tempatlahir.required' => 'Tempat lahir wajib diisi.',
            'agama.required' => 'Agama wajib diisi.',
            'tanggallahir.required' => 'Tanggal lahir wajib diisi.',
            'files.required' => 'Dokumen wajib diunggah.',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'sending';

        if ($request->hasFile('files')) {
            $file = $request->file('files');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('files/akte', $filename, 'public');
            $validated['files'] = $filePath;
        }

        LayananAkteModel::create($validated);

        return redirect()->route('dashboard')->with('success', 'Data berhasil disimpan.');
    }


    public function update($id)
    {
        $akte = LayananAkteModel::find($id);
        return view("dashboard.users.akteedit", compact("akte"));
    }

    public function updatestore(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'nama' => 'required|max:255',
                'kk' => 'nullable',
                'nik' => 'nullable|min:16',
                'jeniskelamin' => 'required',
                'tempatlahir' => 'required',
                'agama' => 'required',
                'tanggallahir' => 'required',
                'files' => 'nullable|file',
            ], [
                'nama.required' => 'Nama wajib diisi.',
                'kk.required' => 'Nomor KK harus diisi',
                'nik.required' => 'NIK harus berisi 16 min',
                'jeniskelamin.required' => 'Jenis kelamin wajib dipilih.',
                'jeniskelamin.in' => 'Jenis kelamin yang dipilih tidak valid.',
                'tempatlahir.required' => 'Tempat lahir wajib diisi.',
                'agama.required' => 'Agama wajib diisi.',
                'tanggallahir.required' => 'Tanggal lahir wajib diisi.',
                'files.file' => 'Dokumen wajib diunggah.',
            ]

    );

        $validatedData["status"] = "sending";
        $layananAkte = LayananAkteModel::findOrFail($id);

        if ($request->hasFile('files')) {
            if ($layananAkte->files && \Storage::disk('public')->exists($layananAkte->files)) {
                \Storage::disk('public')->delete($layananAkte->files);
            }

            $file = $request->file('files');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('files/akte', $filename, 'public');
            $validatedData['files'] = $filePath;
        }

        $layananAkte->update($validatedData);

        return redirect()->route('dashboard')->with('success', 'Data berhasil diperbarui.');
    }


    public function message($id)
    {
        $id = LayananAkteModel::findOrFail($id);
        return view("dashboard.admin.layanan.akte.message", compact("id"));
    }

    public function postmessage(Request $request,$id)
    {
        $kk = LayananAkteModel::find($id);

        $kk->message = $request->message;
        $kk->save();

        return redirect()->route("managementakte.index");
    }

    public function destroy($id)
    {
        $layananAkte = LayananAkteModel::find($id);

        if (!$layananAkte) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan.'
            ], 404);
        }

        if ($layananAkte->files && Storage::disk('public')->exists($layananAkte->files)) {
            Storage::disk('public')->delete($layananAkte->files);
        }


        $layananAkte->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus.'
        ]);
    }
}
