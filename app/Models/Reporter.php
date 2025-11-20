<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Post;

class Reporter extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'email',
        'position',
        'photo'
    ];
    
    public function post()
    {
        return $this->hasMany(Post::class);
    }
}
