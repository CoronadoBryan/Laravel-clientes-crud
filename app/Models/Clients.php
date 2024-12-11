<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'start_date',
        'end_date',
        'avatar',
        'privacity',
        'user_id'
    ];
}
