<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananKTPModel extends Model
{
    use HasFactory;
    protected $table = "layanan_ktp";
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
