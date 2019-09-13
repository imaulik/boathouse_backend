<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Potntial_auction_form extends Model
{

    protected $softDelete = true;
    protected $fillable = ['user_id', 'first_name', 'last_name', 'email', 'mobile_no', 'year', 'make', 'length', 'broker_check', 'brokerage_name'];

    public function userdetails()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

}
