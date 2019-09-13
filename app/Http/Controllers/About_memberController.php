<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\About_member;
use Validator;

class About_memberController extends BaseController
{

    public function __construct()
    {
        
    }

    public function SaveAbout_member(Request $request)
    {
        $data = $request->all();
        if (isset($data))
        {
            if (isset($data['id']))
            {
                $about_member = About_member::find($data['id']);
                if ($about_member)
                {
                    $about_member->update($data);
                }
            } else
            {
                About_member::create($data);
            }
//            return $this->formatSuccessResponse('Created Successfully', '');
            return $this->JSONformatSuccessResponse('Created Successfully');
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function getAbout_members(Request $request)
    {
        $filter = $request->all();
        if (isset($filter))
        {
            $query = About_member::query();
            $totalrecords = $query->count();

            $query1 = About_member::query();
            $query1 = $query1->take($filter['rows'])
                    ->skip($filter['first']);
            $query1 = $query1->where(function ($qu2) use ($filter)
                    {
                        $qu2->orWhere('member_name', 'like', '%' . $filter['globalFilter'] . '%');
                    })
                    ->orderBy($filter['columns'], $filter['sortype']);
            $data = $query1->get();
            return $this->JSONformatSuccessResponse(compact('data', 'totalrecords'));
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function getAbout_memberById(Request $request)
    {
        $data = $request->all();
        if ($request->id)
        {
            $home_slider = About_member::where('id', '=', $request->id)
                            ->first()->toArray();

            return $this->JSONformatSuccessResponse($home_slider);
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function deleteAbout_member(Request $request)
    {
        if ($request->id)
        {
            About_member::where('id', $request->id)->delete();
            return $this->JSONformatSuccessResponse('Deleted Successfully');
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function getAllMembers(Request $request)
    {
        $member_abouts = About_member::get()->toArray();
        return view('about_us', compact('member_abouts'));
    }

}
