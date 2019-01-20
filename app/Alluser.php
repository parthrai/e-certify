<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alluser extends Model
{
    //
    protected $fillable = [
        'name', 'email', 'password','license','phone',

    ];
}

