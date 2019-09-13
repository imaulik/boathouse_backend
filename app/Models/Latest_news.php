<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Latest_news extends Model
{

    protected $softDelete = true;
    protected $fillable = ['title', 'description', 'link', 'user_id','publish_date'];

    public function userselect()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

}
