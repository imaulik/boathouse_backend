<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Potntial_auction_form;
use Validator;

class Potntial_auctionController extends BaseController
{

    public function __construct()
    {
        
    }

    public function SavePotntial_auction(Request $request)
    {
        $data = $request->all();

        $messsages = array(
            'first_name.required'   => 'First Name is required',
            'last_name.required'    => 'Last Name is required',
            'email.required'        => 'Email Id is required',
            'mobile_no.required'    => 'Cell is required',
            'year.required'         => 'Year is required',
            'make.required'         => 'Make is required',
            'length.required'       => 'Length is required',
            'broker_check.required' => 'Field is required'
        );

        $rules = [
            'first_name'   => 'required',
            'last_name'    => 'required',
            'email'        => 'required',
            'mobile_no'    => 'required',
            'year'         => 'required',
            'make'         => 'required',
            'length'       => 'required',
            'broker_check' => 'required'
        ];

        $validator = Validator::make($data, $rules, $messsages);
        if ($validator->fails())
        {
            return redirect('/post_new_auction')->with('message', 'error')->withErrors($validator);
        } else
        {
            if (isset($data['id']))
            {
                $potntial_auction = Potntial_auction_form::find($data['id']);
                if ($potntial_auction)
                {
                    $potntial_auction->update($data);
                    return $this->JSONformatSuccessResponse('Updated Successfully');
                }
            } else
            {
                Potntial_auction_form::create($data);
                return $this->JSONformatSuccessResponse('Created Successfully');
            }
        }
    }

    public function getPotntial_auctions(Request $request)
    {
        $filter = $request->all();
        if (isset($filter))
        {
            $query = Potntial_auction_form::query();
            $totalrecords = $query->count();

            $query1 = Potntial_auction_form::query();
            $query1 = $query1->take($filter['rows'])
                    ->skip($filter['first']);
            $query1 = $query1->where(function ($qu2) use ($filter)
                    {
                        $qu2->orWhere('first_name', 'like', '%' . $filter['globalFilter'] . '%');
                    })
                    ->orderBy($filter['columns'], $filter['sortype']);
            $data = $query1->get();
            return $this->JSONformatSuccessResponse(compact('data', 'totalrecords'));
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function getPotntial_auctionById(Request $request)
    {
        $data = $request->all();
        if ($request->id)
        {
            $vessel_bids = Potntial_auction_form::where('id', '=', $request->id)
                            ->first()->toArray();

            return $this->JSONformatSuccessResponse($vessel_bids);
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function deletePotntial_auction(Request $request)
    {
        if ($request->id)
        {
            Potntial_auction_form::where('id', $request->id)->delete();
            return $this->JSONformatSuccessResponse('Deleted Successfully');
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

}
