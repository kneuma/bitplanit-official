<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'text',
        'finished',
        'user_id',
        'mins',
        'combined_time',
        'description',
        'due_date',
        'avatar',
        'priority',
        'in_progress'
    ];

    protected $casts = [
        'finished' => 'boolean',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
