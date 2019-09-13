<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeTestimonial extends Model
{
    //
    protected $softDelete = true;
    protected $table = 'home_testimonial';
    protected $fillable = [
        'author','designation','title','description','status'
    ];
}
