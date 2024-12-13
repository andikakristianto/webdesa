<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentsModel extends Model
{
    use HasFactory;

    protected $table = "comments";
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belongsTo(ArticleModel::class);
    }
}
