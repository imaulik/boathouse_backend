<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vessel_additional_field extends Model
{

    protected $softDelete = true;
    protected $fillable = ['vessel_id', 'title', 'field_filename'];

    public function vesseltdetails()
    {
        return $this->belongsTo('App\Models\Vessel_details', 'vessel_id', 'id');
    }


}
