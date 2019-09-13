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

class email_subscriberController extends BaseController
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
                return $this->formatSuccessResponse('Updated Successfully', '');
            } else
            {
                return response()->json($this->formatUnsuccessResponse('User not Registerd'), 500);
            }
        } else
        {
            $vessel = Vessel_comment::create($data);
            return $this->formatSuccessResponse('Created Successfully', '');
        }
    }

}
