<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\District;
use App\Models\Post;
class Division extends Model
{
    use HasFactory;
    
    public function district()
    {
        return $this->hasMany(District::class);
    }
    
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
