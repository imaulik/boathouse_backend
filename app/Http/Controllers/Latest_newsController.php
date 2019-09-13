<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Latest_news;
use Validator;
use DateTime;

class Latest_newsController extends BaseController
{

    public function __construct()
    {
        
    }

    public function SaveLatest_news(Request $request)
    {
        $data = $request->all();
        if (isset($data))
        {
            if (isset($data['publish_date']))
            {
                $data['publish_date'] = new DateTime($data['publish_date']);
            }
            if (isset($data['id']))
            {
                $latest_news = Latest_news::find($data['id']);
                if ($latest_news)
                {
                    $latest_news->update($data);
                    return $this->JSONformatSuccessResponse('Updated Successfully');
                } else
                {
                    return $this->JSONformatUnsuccessResponse('Please provide parameter');
                }
            } else
            {
                $data['user_id'] = auth('web')->id();
                Latest_news::create($data);
                return $this->JSONformatSuccessResponse('Created Successfully');
            }
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function getLatest_newss(Request $request)
    {
        $filter = $request->all();
        if (isset($filter))
        {
            $query = Latest_news::query();
            $totalrecords = $query->count();

            $query1 = Latest_news::query();
            $query1 = $query1->take($filter['rows'])
                    ->skip($filter['first']);
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

    public function getLatest_newsById(Request $request)
    {
        $data = $request->all();
        if ($request->id)
        {
            $latest_news = Latest_news::where('id', '=', $request->id)
                            ->first()->toArray();
            return $this->JSONformatSuccessResponse($latest_news);
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function deleteLatest_news(Request $request)
    {
        if ($request->id)
        {
            Latest_news::where('id', $request->id)->delete();
            return $this->JSONformatSuccessResponse('Deleted Successfully');
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

}
