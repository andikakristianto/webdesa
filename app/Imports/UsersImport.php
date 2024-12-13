<?php
namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (empty($row['name'])) {
            return null;
        }

        $jenisKelamin = trim(strtolower($row['jenis_kelamin'] ?? ''));
        if ($jenisKelamin !== 'laki' && $jenisKelamin !== 'perempuan') {
            $jenisKelamin = null;
        }

        $tglLahir = $row['tgl_lahir'] ?? null;
        if ($tglLahir && !\DateTime::createFromFormat('d-m-Y', $tglLahir)) {
            $tglLahir = null;
        }

        return new User([
            'name' => $row['name'],
            'no_hp' => $row['no_hp'] ?? null,
            'email' => $row['email'] ?? null,
            'password' => bcrypt($row['password'] ?? ''),
            'nik' => $row['nik'] ?? null,
            'kk' => $row['kk'] ?? null,
            'jenis_kelamin' => $jenisKelamin,
            'tgl_lahir' => $tglLahir,
            'domisili' => $row['domisili'] ?? null,
        ]);
    }
}
