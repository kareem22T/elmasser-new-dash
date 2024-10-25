<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class Category extends Model
{
    use HasFactory, HasEagerLimit;

    public $guarded = ['id', 'created_at', 'updated_at'];
    public $appends = ['url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUrlAttribute()
    {
        return route('category.show', $this);
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id')->latest();
    }

    public function image()
    {
        if ($this->image == null)
            return env('DEFAULT_IMAGE');
        else
            return env("STORAGE_URL") . "/uploads/categories/" . $this->image;
    }
}
