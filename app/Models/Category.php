<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\Post;
use App\Models\Draft;
use App\Models\Photo;
use App\Models\VideoGallery;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = [ 'name', 'slug', 'position'];
    // protected $table = 'categories';
    

    public function SubCategory()
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function draft()
    {
        return $this->belongsToMany(Draft::class);
    }

    public function photos()
    {
        return $this->belongsToMany(Photo::class);
    }

    public function videoGallery()
    {
        return $this->belongsToMany(VideoGallery::class);
    }

    public function Videos()
    {
        return $this->belongsToMany(VideoGallery::class);
    }

    
}
