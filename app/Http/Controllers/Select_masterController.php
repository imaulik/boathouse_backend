<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Select_master;
use Validator;

class Select_masterController extends BaseController
{

    public function __construct()
    {
        
    }

    public function saveSelect_master(Request $request)
    {
        $data = $request->all();
        if ($request->id)
        {
            $rules = ['name' => 'required|unique:select_masters,name,' . $request->id];
            $validator = Validator::make($data, $rules);
            if ($validator->fails())
            {
                return $this->JSONformatUnsuccessResponse('Name Already Registerd');
            } else
            {
                $select_master = Select_master::find($request->id);
                if ($select_master)
                {
                    $select_master->update(['name' => $data['name']]);
                    return $this->JSONformatSuccessResponse('Updated Successfully');
                } else
                {
                    return $this->JSONformatUnsuccessResponse('Error not updated');
                }
            }
        } else
        {
            $rules = ['name' => 'unique:select_masters,name'];
            $validator = Validator::make($data, $rules);
            if ($validator->fails())
            {
                return $this->JSONformatUnsuccessResponse('Name Already Registerd');
            } else
            {
                Select_master::create(['name' => $data['name']]);
                return $this->JSONformatSuccessResponse('Created Successfully');
            }
        }
    }

    public function getSelect_master(Request $request)
    {
        if ($request->id)
        {
            $select_master = Select_master::find($request->id);
        }
        return $this->JSONformatSuccessResponse($select_master);
    }

    public function getSelect_masters(Request $request)
    {
        $filter = $request->all();
        if (isset($filter))
        {

            $totalrecords = Select_master::count();

            $data = Select_master::take($filter['rows'])
                    ->skip($filter['first'])
                    ->orderBy($filter['columns'], $filter['sortype'])
                    ->orWhere('name', 'like', '%' . $filter['globalFilter'] . '%')
                    ->get();
            return $this->JSONformatSuccessResponse(compact('data', 'totalrecords'));
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function getAllSelect_master(Request $request)
    {
        $select_master = Select_master::get()->toArray();
        return $this->JSONformatSuccessResponse($select_master);
    }

    public function deleteSelect_master(Request $request)
    {
        if ($request->id)
        {
            $select_master = Select_master::where('id', $request->id)->delete();
        }
        return $this->JSONformatSuccessResponse($select_master);
    }

}
