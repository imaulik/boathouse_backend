<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasRoles;
    use Notifiable;
    protected $softDelete = true;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname',
        'email', 'password',
        'remember_token', 'status_id',
        'address', 'city', 'zipcode',
        'province_code', 'phone',
        'profile_image',
        'username','broker','accept_terms'
    ];
    protected $casts = [
        'status_id' => 'integer',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function status()
    {
        return $this->belongsTo('App\Models\Option_master', 'status_id', 'id');
    }

    public function roles()
    {
        return $this->belongsToMany('Spatie\Permission\Models\Role','model_has_roles','model_id');
    }
    
}
