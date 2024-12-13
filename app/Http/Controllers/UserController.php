<?php

namespace App\Http\Controllers;

use App\Models\LayananAkteModel;
use App\Models\LayananKKModel;
use App\Models\LayananKTPModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function kk()
    {
        $kk = LayananKKModel::where("user_id", Auth::user()->id)->get();

        return view("dashboard.users.layanan.kk", compact("kk"));
    }

    public function ktp() {
        $ktp = LayananKTPModel::where("user_id", Auth::user()->id)->get();

        return view("dashboard.users.layanan.ktp", compact("ktp"));
    }

    public function akte() {
        $akte = LayananAkteModel::where("user_id", Auth::user()->id)->get();

        return view("dashboard.users.layanan.akte", compact("akte"));
    }
}
