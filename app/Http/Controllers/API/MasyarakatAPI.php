<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class MasyarakatAPI extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->get();

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($user) {
                $editUrl = route('masyarakat.edit', ['id' => $user->id]);
                $editButton = '<a href="' . $editUrl . '" class="btn py-2 px-4" >Edit</a>';
                $deleteButton = '<button class="btn py-2 px-4 bg-red-500" onclick="deleteUser(' . $user->id . ')">Delete</button>';
                return $editButton . ' ' . $deleteButton;
            })
            ->make(true);
    }
}
