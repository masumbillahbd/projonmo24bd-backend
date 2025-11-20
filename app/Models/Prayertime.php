<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prayertime extends Model
{
    use HasFactory;
    protected $fillable = ['fajr','zuhr','asr','maghrib','isha'];
    protected $table = 'prayertimes';
}
