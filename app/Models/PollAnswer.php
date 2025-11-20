<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollAnswer extends Model
{
    protected $fillable = ['poll_id', 'poll_answer_id', 'session_id'];

}
