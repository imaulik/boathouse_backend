<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vessel_comment extends Model
{

    //
    protected $primaryKey = 'id';
    protected $fillable = [
        'vessel_id', 'user_id', 'comment_message'
    ];

    public function vesseltdetails()
    {
        return $this->belongsTo('App\Models\Vessel_details','vessel_id', 'id');
    }

    public function userdetails()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    

}
