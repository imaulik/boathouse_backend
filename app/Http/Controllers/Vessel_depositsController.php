<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\email_subscriber;
use App\Models\Vessel_details;
use App\Models\Vessel_comment;
use App\Models\Vessel_gallery;
use App\Models\vessel_user_deposit;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Validator;
use DateTime;

class Vessel_depositsController extends BaseController
{

    public function __construct()
    {
        
    }

    public function SaveVessel_deposit(Request $request)
    {
        $data = $request->all();
        if (isset($data))
        {
            $vessele_user = vessel_user_deposit::where('user_id', $data['user_id'])
                            ->where('vessel_id', $data['vessel_id'])->get()->toArray();
            if (isset($vessele_user[0]) && isset($vessele_user[0]['id']))
            {
                return $this->JSONformatUnsuccessResponse('Deposit Already Paid');
            } else
            {
                if (isset($data['check_broker']) && $data['check_broker'] == 'broker')
                {
                    $data['check_broker'] = 1;
                } else
                {
                    $data['check_broker'] = 0;
                }
                vessel_user_deposit::create($data);
                return $this->JSONformatSuccessResponse('Created Successfully');
            }
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function getVessel_deposits(Request $request)
    {
        $filter = $request->all();
        if (isset($filter))
        {
            $query = vessel_user_deposit::query();
            $totalrecords = $query->count();

            $query1 = vessel_user_deposit::query();
            $query1 = $query1->take($filter['rows'])
                    ->skip($filter['first'])
                    ->with(['vesseltdetails', 'userdetails']);
            $query1 = $query1->where(function ($qu2) use ($filter)
                    {
//                        $qu2->orWhere('email', 'like', '%' . $filter['globalFilter'] . '%');
                    })
                    ->orderBy($filter['columns'], $filter['sortype']);
            $data = $query1->get();
            return $this->JSONformatSuccessResponse(compact('data', 'totalrecords'));
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function getVessel_depositById(Request $request)
    {
        $data = $request->all();
        if ($request->id)
        {
            $vessel_comment = vessel_user_deposit::where('id', '=', $request->id)
                            ->with(['vesseltdetails', 'userdetails'])
                            ->first()->toArray();

            return $this->JSONformatSuccessResponse($vessel_comment);
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function getVesseleDepositForm($slug)
    {
        if ($slug != '')
        {
            $data = Vessel_details::where('slug', $slug)->first()->toArray();
            return view('online_bid.deposit_form', compact('data'));
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function saveVesseleDepositForm(Request $request)
    {
        $data = $request->all();

        if (isset($data))
        {
            $vessele_user = vessel_user_deposit::where('user_id', $data['user_id'])
                            ->where('vessel_id', $data['vessel_id'])->get()->toArray();
            if (isset($vessele_user[0]) && isset($vessele_user[0]['id']))
            {
                return $this->JSONformatUnsuccessResponse('Deposit Already Paid');
            } else
            {
                if (isset($data['check_broker']) && $data['check_broker'] == 'broker')
                {
                    $data['check_broker'] = 1;
                } else
                {
                    $data['check_broker'] = 0;
                }
                vessel_user_deposit::create($data);
                return $this->JSONformatSuccessResponse('Created Successfully');
            }
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

}
