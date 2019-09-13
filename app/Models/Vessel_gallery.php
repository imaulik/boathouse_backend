<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vessel_gallery extends Model
{

    //
    protected $fillable = [
        'vessel_id', 'level_number', 'image_name'
    ];

    public function vesseltdetails()
    {
        return $this->belongsTo('App\Models\Vessel_details', 'vessel_id', 'id');
    }

}
