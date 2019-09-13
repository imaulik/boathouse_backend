<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\HomeTestimonial;
use Validator;

class HomeTestimonialController extends BaseController
{

    public function __construct()
    {
        
    }

    public function SaveHomeTestimonial(Request $request)
    {
        $data = $request->all();
        if (isset($data))
        {
            if (isset($data['id']))
            {
                $home_testimonial = HomeTestimonial::find($data['id']);
                if ($home_testimonial)
                {
                    $home_testimonial->update($data);
                }
            } else
            {
                HomeTestimonial::create($data);
            }
            return $this->JSONformatSuccessResponse('Created Successfully');
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function getHomeTestimonial(Request $request)
    {
        $filter = $request->all();
        if (isset($filter))
        {
            $query = HomeTestimonial::query();
            $totalrecords = $query->count();

            $query1 = HomeTestimonial::query();
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

    public function getHomeTestimonialById(Request $request)
    {
        $data = $request->all();
        if ($request->id)
        {
            $home_slider = HomeTestimonial::where('id', '=', $request->id)
                            ->first()->toArray();

            return $this->JSONformatSuccessResponse($home_slider);
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function deleteHomeTestimonial(Request $request)
    {
        if ($request->id)
        {
            HomeTestimonial::where('id', $request->id)->delete();
            return $this->JSONformatSuccessResponse('Deleted Successfully', '');
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

}
