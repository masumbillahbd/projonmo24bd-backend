<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class LeadPost extends Model
{
    use HasFactory;

    protected $fillable = ['position'];
    public function Posts(){
        return $this->belongsTo(Post::class);
    }
}
