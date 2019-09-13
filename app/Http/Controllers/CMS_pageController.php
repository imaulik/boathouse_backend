<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\email_subscriber;
use App\Models\Vessel_details;
use App\Models\Vessel_comment;
use App\Models\Vessel_gallery;
use App\Models\cms_page;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Validator;
use DateTime;

class CMS_pageController extends BaseController
{

    public function __construct()
    {
        
    }

    public function SaveCMS_page(Request $request)
    {
        $data = $request->all();
        if (isset($data))
        {
            if (isset($data['id']))
            {
                $cms_page = cms_page::find($data['id']);
                if ($cms_page)
                {
                    $cms_page->update($data);
                    return $this->JSONformatSuccessResponse('Updated Successfully');
                } else
                {
                    return $this->JSONformatUnsuccessResponse('Please provide parameter');
                }
            } else
            {
                cms_page::create($data);
                return $this->JSONformatSuccessResponse('Created Successfully');
            }
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function getCMS_pages(Request $request)
    {
        $filter = $request->all();
        if (isset($filter))
        {
            $query = cms_page::query();
            $query = $query->where('option_id', '=', $filter['option_id']);
            $totalrecords = $query->count();

            $query1 = cms_page::query();
            $query1 = $query1->take($filter['rows'])
                    ->skip($filter['first']);
            $query1 = $query1->where('option_id', '=', $filter['option_id']);
            $query1 = $query1->where(function ($qu2) use ($filter)
                    {
                        $qu2->orWhere('title', 'like', '%' . $filter['globalFilter'] . '%');
                    })
                    ->orderBy($filter['columns'], $filter['sortype']);
            $data = $query1->get();
            return $this->JSONformatSuccessResponse(compact('data', 'totalrecords'));
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function getCMS_pageById(Request $request)
    {
        $data = $request->all();
        if ($request->id)
        {
            $cms_page = cms_page::where('id', '=', $request->id)
                            ->first()->toArray();
            return $this->JSONformatSuccessResponse($cms_page);
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function deleteCMS_page(Request $request)
    {
        if ($request->id)
        {
            cms_page::where('id', $request->id)->delete();
            return $this->JSONformatSuccessResponse('Deleted Successfully');
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

}
