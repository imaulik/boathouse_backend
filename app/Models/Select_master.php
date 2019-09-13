<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Select_master extends Model
{
   use SoftDeletes;
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','title'
    ];
    public function optionselect()
    {
        return $this->hasMany('App\Models\Option_master');
    }
}
