<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option_master extends Model
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'select_id', 'key_text', 'value_text'
    ];
    protected $casts = [
        'select_id' => 'integer'
    ];

    public function selectcategory()
    {
        return $this->belongsTo('App\Models\Select_master', 'select_id', 'id');
    }

}
