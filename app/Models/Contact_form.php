<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact_form extends Model
{

    protected $softDelete = true;
    protected $fillable = ['name', 'email', 'mobile_no','comment_message'];

}
