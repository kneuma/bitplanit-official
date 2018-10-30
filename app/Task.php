<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'text',
        'finished',
    ];

    protected $casts = [
        'finished' => 'boolean',
    ];
}
