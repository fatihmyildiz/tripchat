<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $fillable = [
        'hotel_id',
        'name',
        'email',
        'password',
        'xp',
        'photo',
        'token',
    ];

    protected $hidden = [
        'password',
        'token',
        'remember_token',
    ];
}
