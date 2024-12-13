<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananKKModel extends Model
{
    use HasFactory;

    protected $table = "layanan_kk";
    protected $guarded = [];


    public function users()
    {
        return $this->belongsTo(User::class, "user_id");
    }

}
