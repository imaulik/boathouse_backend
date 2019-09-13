<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Home_slider;
use Validator;

class Home_SliderController extends BaseController
{

    public function __construct()
    {
        
    }

    public function SaveHome_Slider(Request $request)
    {
        $data = $request->all();
        if (isset($data))
        {
            if (isset($data['id']))
            {
                $home_slider = Home_slider::find($data['id']);
                if ($home_slider)
                {
                    $home_slider->update($data);
                }
            } else
            {
                Home_slider::create($data);
            }
            return $this->JSONformatSuccessResponse('Created Successfully');
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function getHome_Sliders(Request $request)
    {
        $filter = $request->all();
        if (isset($filter))
        {
            $query = Home_slider::query();
            $totalrecords = $query->count();

            $query1 = Home_slider::query();
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

    public function getHome_SliderById(Request $request)
    {
        $data = $request->all();
        if ($request->id)
        {
            $home_slider = Home_slider::where('id', '=', $request->id)
                            ->first()->toArray();

            return $this->JSONformatSuccessResponse($home_slider);
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function deleteHome_Slider(Request $request)
    {
        if ($request->id)
        {
            Home_slider::where('id', $request->id)->delete();
            return $this->JSONformatSuccessResponse('Deleted Successfully', '');
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

}
