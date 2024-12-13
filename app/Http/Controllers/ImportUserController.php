<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class ImportUserController extends Controller
{
    public function index()
    {
        return view("dashboard.admin.management_user.import");
    }

    public function store(Request $request)
    {
        // Validasi file yang diupload
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        try {
            // Mengimpor file yang diunggah
            Excel::import(new UsersImport, $request->file('file'));

            // Jika berhasil
            return back()->with('success', 'Data berhasil diimpor!');
        } catch (ValidationException $e) {
            // Jika terjadi error saat validasi excel
            $errors = $e->errors(); // Menyimpan error dari validasi Excel
            return back()->withErrors($errors)->withInput();
        } catch (\Exception $e) {
            // Jika terjadi error lainnya
            return back()->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
        }
    }
}
