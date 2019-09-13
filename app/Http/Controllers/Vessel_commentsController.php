<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Vessel_details;
use App\Models\Vessel_comment;
use App\Models\Vessel_gallery;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Validator;
use DateTime;

class Vessel_commentsController extends BaseController
{

    public function __construct()
    {
        
    }

    public function saveVessel_comments(Request $request)
    {
        $data = $request->all();

        if (isset($data['id']))
        {
            $vessel_details = Vessel_comment::find($data['id']);
            if ($vessel_details)
            {
                $vessel_details->update($data);
                return $this->JSONformatSuccessResponse('Updated Successfully');
            } else
            {
                return $this->JSONformatUnsuccessResponse('User not Registerd');
            }
        } else
        {
            $vessel = Vessel_comment::create($data);
            return $this->JSONformatSuccessResponse('Created Successfully');
        }
    }

    public function getVessel_comments(Request $request)
    {
        $filter = $request->all();

        if (isset($filter))
        {

            $query = Vessel_comment::query();
            $totalrecords = $query->count();

            $query1 = Vessel_comment::query();
            $query1 = $query1->take($filter['rows'])
                    ->skip($filter['first'])
                    ->with(['vesseltdetails', 'userdetails']);
            $query1 = $query1->where(function ($qu2) use ($filter)
                    {
//                        $qu2->orWhere('id', 'like', '%' . $filter['globalFilter'] . '%');
                    })
                    ->orderBy($filter['columns'], $filter['sortype']);
            $data = $query1->get();
            return $this->JSONformatSuccessResponse(compact('data', 'totalrecords'));
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function getVessel_commentByID(Request $request)
    {
        $data = $request->all();

        if ($request->id)
        {
            $vessel_comment = Vessel_comment::where('id', '=', $request->id)
                            ->with(['vesseltdetails', 'userdetails'])
                            ->first()->toArray();

            return $this->JSONformatSuccessResponse($vessel_comment);
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

}
