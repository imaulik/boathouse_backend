<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cms_page extends Model
{
        protected $fillable = [
        'option_id', 'title','description','status'
    ];
}
