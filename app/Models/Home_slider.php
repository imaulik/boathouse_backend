<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Home_slider extends Model
{

    protected $softDelete = true;
    protected $fillable = ['title', 'description', 'slider_image'];

}
