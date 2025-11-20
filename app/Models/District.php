<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
class District extends Model
{
    use HasFactory;
    
    public function division()
    {
        return $this->belongsTo(Division::class);
    }
    
    public function upazila()
    {
        return $this->hasMany(Upazila::class);
    }
    
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
