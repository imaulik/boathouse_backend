<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About_member extends Model
{

    protected $softDelete = true;
    protected $fillable = ['member_name', 'member_designation','member_description', 'member_image'];

}
