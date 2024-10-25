<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class Article extends Model
{
    use HasFactory, HasEagerLimit;

    public $guarded = ['id', 'created_at', 'updated_at'];

    public function item_seens()
    {
        return $this->hasMany(ItemSeen::class, 'type_id', 'id')->where('type', "ARTICLE");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(ArticleComment::class, 'article_id');
    }

    public function main_image($type = null)
    {
        if ($this->main_image == null)
            return env('DEFAULT_IMAGE');
        else if ($type == "small")
            return env("STORAGE_URL") . $this->main_image;
        else
            return env("STORAGE_URL") . $this->main_image;
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tags');
    }
}
