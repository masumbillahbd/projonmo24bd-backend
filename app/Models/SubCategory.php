<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [ 'name', 'slug', 'position'];
    // protected $table = 'sub_categories';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
