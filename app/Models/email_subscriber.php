<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class email_subscriber extends Model
{

    protected $fillable = [
        'email', 'check_broker'
    ];

}
