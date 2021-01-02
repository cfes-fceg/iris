<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionStream extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'zoom_meeting_id'
    ];
}