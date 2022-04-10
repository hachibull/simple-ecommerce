<?php

namespace App\Models;

use App\Models\Category as ModelsCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    public $guarded=[];

    public function parent_category(){
        return $this->belongsTo(Category::class);
    }

    public function child_category(){
        return $this->hasMany(Category::class);
    } 
    public function products(){
        return $this->hasMany(Product::class);
    }

    protected static function booted()
    {
        static::created(function ($category) {
            $category->slug=Str::slug($category->title);
        });
    }
}
