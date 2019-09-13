<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vessel_details extends Model
{

    //
    protected $fillable = [
        'title','user_id', 'slug','incremental_bid','deposit_amount', 'description', 'feature_image', 'location', 'year', 'make', 'model',
        'loa', 'beam', 'draft', 'co_brokerage ', 'broker_name', 'broker_email', 'broker_logo', 'preview_period',
        'haul_out', 'sea_trial', 'auction_feature', 'auction_address', 'auction_start_price', 'auction_reserve_price',
        'auction_buy_now_price', 'auction_quantity', 'auction_begins', 'auction_ends', 'buyer_document_agreement', 'allowed_comment','bidders_agreement','opening_bid_incentive','gallery_order'
    ];

    public function commentselect()
    {
        return $this->hasMany('App\Models\Vessel_comment', 'vessel_id', 'id')->with('userdetails');
    }

    public function galleryimages()
    {
        return $this->hasMany('App\Models\Vessel_gallery', 'vessel_id', 'id');
    }

    public function additionalFields()
    {
        return $this->hasMany('App\Models\Vessel_additional_field', 'vessel_id', 'id');
    }

    public function bidselect()
    {
        return $this->hasMany('App\Models\Vessel_bids', 'vessel_id', 'id')->with('userdetails');
    }
 
    public function depositselect()
    {
        return $this->hasMany('App\Models\vessel_user_deposit', 'vessel_id', 'id')->with('userdetails');
    }
 
    public function userselect()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

}
