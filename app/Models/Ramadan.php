<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ramadan extends Model
{
    use HasFactory;
    protected $fillable  = ['user_id','division','ramadan_no','date','sehri','iftar','position'];
}
