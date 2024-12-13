<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\LayananAkteModel;
use App\Models\LayananKKModel;
use App\Models\LayananKTPModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view("dashboard.admin.management_user.user");
    }

    public function tambah()
    {
        return view("dashboard.admin.management_user.tambah");
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            "name" => "required|string",
            "email" => "required",
            "password" => "required",
            "nik" => "nullable",
            "kk" => "nullable",
            "profile" => "nullable",
            "jenis_kelamin" => "required",
        ],[
            "name.required" => "Masukan Nama Terlebih Dahulu",
            "name.string" => "Nama Harus String tidak boleh ada double atau int",
            "email.required" => "Masukan Email Terlebih Dahulu",
            "email.email" => "Email harus berupa email @gmail.com atau yang lain nya",
            "passowrd.required" => "Masukan Password Terlebih Dahulu",
            "nik.min" => "Minimal 16 Digits NIK",
            "jenis_kelamin.required" => "Jenis Kelamin Diperlukan",
        ]);

        $validate["password"] = Hash::make($request->password);

        if ($request->hasFile("profile")) {
            $file = $request->file('profile');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('profile/picture', $filename, 'public');
            $validate['profile'] = $filePath;
        }

        User::create($validate);

        return redirect()->route("masyarakat.index");
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view("dashboard.admin.management_user.edit", compact("user"));
    }


    public function editstore(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validate = $request->validate([
            "name" => "required|string",
            "email" => "required|email|unique:users,email," . $id,
            "password" => "nullable",
            "nik" => "nullable|min:16",
            "kk" => "nullable",
            "profile" => "nullable|file",
            "jenis_kelamin" => "required",
            "domisili" => "required",
        ], [
            "name.required" => "Masukan Nama Terlebih Dahulu",
            "name.string" => "Nama Harus String tidak boleh ada double atau int",
            "email.required" => "Masukan Email Terlebih Dahulu",
            "email.email" => "Email harus berupa email @gmail.com atau yang lain nya",
            "email.unique" => "Email sudah digunakan",
            "password.required" => "Masukan Password Terlebih Dahulu",
            "nik.min" => "Minimal 16 Digits NIK",
            "jenis_kelamin.required" => "Jenis Kelamin Diperlukan",
        ]);

        if ($request->filled('password')) {
            $validate['password'] = Hash::make($request->password);
        } else {
            unset($validate['password']);
        }

        if ($request->hasFile('profile')) {
            if ($user->profile) {
                \Storage::disk('public')->delete($user->profile);
            }
            $file = $request->file('profile');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('profile/picture', $filename, 'public');
            $validate['profile'] = $filePath;
        }

        $user->update($validate);

        return redirect()->route("masyarakat.index")->with('success', 'User berhasil diperbarui');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        LayananKKModel::where("user_id", $id)->delete();
        LayananKTPModel::where("user_id", $id)->delete();
        LayananAkteModel::where("user_id", $id)->delete();

        // Hapus file profil jika ada
        if ($user->profile && \Storage::disk('public')->exists($user->profile)) {
            \Storage::disk('public')->delete($user->profile);
        }

        // Hapus pengguna
        $user->delete();

        return redirect()->back()->with('success', 'User dan data terkait berhasil dihapus.');
    }


}
