<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananAkteModel extends Model
{
    use HasFactory;
    protected $table = "layanan_akte";
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
