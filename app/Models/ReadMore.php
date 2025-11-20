<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
class ReadMore extends Model
{
    use HasFactory;

    protected $fillable = ['leader','post_id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

}
