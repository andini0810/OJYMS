<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_datetime',
        'end_datetime',
        'location',
    ];

    protected $casts = [
        'start_datetime' => 'datetime',
    ];
}
