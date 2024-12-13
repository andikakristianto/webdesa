<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleModel extends Model
{
    use HasFactory;

    protected $table = "article";
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function users() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->hasOne(CategoriesModel::class, "id", "category_id");
    }

    public function comments() {
        return $this->hasMany(CommentsModel::class);
    }

    public function tags()
    {
        return $this->belongsTo(ArticleTagsModel::class);
    }
}
