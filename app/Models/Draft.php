<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\Tag;
use App\Models\Category;

class Draft extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }
  
    public function Tag()
    {
        return $this->belongsToMany(Tag::class);
    }
}
