<?php

namespace App\Http\Controllers;

use App\Models\LayananAkteModel;
use App\Models\LayananKKModel;
use App\Models\LayananKTPModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === "user") {
            $kkSending = LayananKKModel::where("status", "sending")->count();
            $ktpSending = LayananKTPModel::where("status","sending")->count();
            $akteSending = LayananAkteModel::where("status", "sending")->count();

            $kkPending = LayananKKModel::where("status", "pending")->count();
            $ktpPending = LayananKTPModel::where("status","pending")->count();
            $aktePending = LayananAkteModel::where("status", "pending")->count();

            $kkAccept = LayananKKModel::where("status", "done")->count();
            $ktpAccept = LayananKTPModel::where("status","done")->count();
            $akteAccept = LayananAkteModel::where("status", "done")->count();


            return view("dashboard.users.index", compact("kkSending", "ktpSending", "akteSending", "kkPending", "ktpPending", "aktePending","kkAccept","ktpAccept","akteAccept"));

        }elseif (Auth::user()->role === "admin") {
            return view("dashboard.admin.index");
        }
    }

    public function profile()
    {
        $user = Auth::user();
        return view("layouts.profile", compact("user"));
    }

    public function profileupdate(Request $request)
    {
        $user = Auth::user();

        $validate = $request->validate([
            "name" => "required|string",
            "email" => "required|email|unique:users,email," . $user->id,
            "password" => "nullable",
            "nik" => "nullable",
            "kk" => "nullable",
            "profile" => "nullable|file",
            "domisili" => "required",
            "jenis_kelamin" => "nullable",
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

        return redirect()->route("dashboard")->with('success', 'User berhasil diperbarui');
    }
}
