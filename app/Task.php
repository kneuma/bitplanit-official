<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tasks;

class Task extends Model
{
    protected $fillable = [
        'text',
        'finished',
        'user_id'
    ];

    protected $casts = [
        'finished' => 'boolean',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tasks(){
        return $this->hasMany(Task::class);
    }


}
