<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Option_master;
use Validator;

class Option_masterController extends BaseController
{

    public function __construct()
    {

    }

    public function saveOption_master(Request $request)
    {
        $data = $request->all();
        if ($request->id) {
            $rules = ['value_text' => 'required|unique:option_masters,value_text,' . $request->id];
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                return $this->JSONformatUnsuccessResponse('Name Already Registerd');
            } else {
                $option_master = Option_master::find($request->id);
                if ($option_master) {
                    $option_master->update(['select_id'=>$data['select_id'],'key_text' => $data['value_text'],'value_text' => $data['value_text']]);
                    return $this->JSONformatSuccessResponse('Updated Successfully');
                } else {
                    return $this->JSONformatUnsuccessResponse('Error not updated');

                }
            }
        } else {
            $rules = ['value_text' => 'unique:option_masters,value_text'];
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                return $this->JSONformatUnsuccessResponse('Name Already Registerd');
            } else {
                Option_master::create(['select_id'=>$data['select_id'],'key_text' => $data['value_text'],'value_text' => $data['value_text']]);
                return $this->JSONformatSuccessResponse('Created Successfully');
            }
        }
    }

    public function getOption_master(Request $request)
    {
        if ($request->id) {
            $option_master = Option_master::find($request->id);
        }
        return $this->JSONformatSuccessResponse($option_master);
    }

    public function getselectOption_masters(Request $request)
    {   
        if ($request->id) {
            $option_master = Option_master::where('select_id', $request->id)->get();
        }
        return $this->JSONformatSuccessResponse($option_master);
    }

    public function getOption_masters(Request $request)
    {
        $filter = $request->all();
        if (isset($filter)) {

            $totalrecords = Option_master::count();

            $data = Option_master::take($filter['rows'])
                ->skip($filter['first'])
                ->orWhere('key_text', 'like',  '%'.$filter['globalFilter']. '%')
                ->Where('select_id', $filter['select_id'])
                ->orderBy($filter['columns'], $filter['sortype'])
                ->get();
            return $this->JSONformatSuccessResponse(compact('data', 'totalrecords'));
        } else {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function getAllOption_master(Request $request)
    {
        $option_master = Option_master::where('select_id', $request->select_id)->get()->toArray();
        return $this->JSONformatSuccessResponse($option_master);
    }

    public function deleteOption_master(Request $request)
    {
        if ($request->id) {
            $option_master = Option_master::where('id', $request->id)->delete();
        }
        return $this->JSONformatSuccessResponse($option_master);
    }

}
