<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleTagsModel extends Model
{
    use HasFactory;

    protected $table = "article_tags";
    protected $guarded = [];

    public function article()
    {
        return $this->belongsTo(ArticleModel::class);
    }

    public function tags() {
        return $this->belongsTo(TagsModel::class);
    }
}
