<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vessel_user_deposit extends Model
{

    //
    protected $primaryKey = 'id';
    protected $fillable = [
        'check_broker', 'user_id', 'vessel_id', 'deposit_amount', 'broker_name', 'brokerage_name'
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

//

