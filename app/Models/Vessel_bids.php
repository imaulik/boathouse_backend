<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vessel_bids extends Model
{

    protected $softDelete = true;
    protected $fillable = ['vessel_id', 'user_id', 'bid_amount', 'winner'];
    protected $attributes = [
        'winner' => '0'
    ];

    public function vesseltdetails()
    {
        return $this->belongsTo('App\Models\Vessel_details', 'vessel_id', 'id');
    }

    public function userdetails()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

}
