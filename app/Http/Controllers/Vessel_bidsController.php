<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Vessel_bids;
use Validator;

class vessel_bidsController extends BaseController
{

    public function __construct()
    {
        
    }

    public function SaveVessel_bid(Request $request)
    {
        $data = $request->all();
        if (isset($data))
        {
            if (isset($data['id']))
            {
                $vessel_bids = Vessel_bids::find($data['id']);
                if ($vessel_bids)
                {
                    $vessel_bids->update($data);
                }
            } else
            {
                Vessel_bids::create($data);
            }
            return $this->formatSuccessResponse('Created Successfully', '');
        } else
        {
            return response()->json($this->formatUnsuccessResponse('Please provide parameter'), 500);
        }
    }

    public function getVessel_bids(Request $request)
    {
        $filter = $request->all();
        if (isset($filter))
        {
            $query = Vessel_bids::query();
            $totalrecords = $query->count();

            $query1 = Vessel_bids::query();
            $query1 = $query1->take($filter['rows'])
                    ->skip($filter['first']);
            $query1 = $query1->where(function ($qu2) use ($filter)
                    {
                        $qu2->orWhere('title', 'like', '%' . $filter['globalFilter'] . '%');
                    })
                    ->orderBy($filter['columns'], $filter['sortype']);
            $data = $query1->get();
            return $this->formatSuccessResponse('', compact('data', 'totalrecords'));
        } else
        {
            return response()->json($this->formatUnsuccessResponse('Please provide parameter'), 500);
        }
    }

    public function getVessel_bidById(Request $request)
    {
        $data = $request->all();
        if ($request->id)
        {
            $vessel_bids = Vessel_bids::where('id', '=', $request->id)
                            ->first()->toArray();

            return $this->formatSuccessResponse('', $vessel_bids);
        } else
        {
            return response()->json($this->formatUnsuccessResponse('Please provide parameter'), 500);
        }
    }

    public function deleteVessel_bid(Request $request)
    {
        if ($request->id)
        {
            Vessel_bids::where('id', $request->id)->delete();
            return $this->formatSuccessResponse('Deleted Successfully', '');
        } else
        {
            return response()->json($this->formatUnsuccessResponse('Please provide parameter'), 500);
        }
    }

}
