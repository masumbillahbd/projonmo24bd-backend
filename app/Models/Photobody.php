<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photobody extends Model
{
    use HasFactory;
    
    public function photos()
    {
        return $this->belongsTo(Photo::class);
    }
}
