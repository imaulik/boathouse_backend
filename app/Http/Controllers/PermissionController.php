<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Option_master;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Validator;

class PermissionController extends BaseController
{

    public function __construct()
    {
        
    }

    public function savePermission(Request $request)
    {
        $data = $request->all();
        if ($request->id)
        {
            $rules = ['name' => 'required|unique:permissions,name,' . $request->id];
            $validator = Validator::make($data, $rules);
            if ($validator->fails())
            {
                return $this->JSONformatUnsuccessResponse('Permissions Name Already Registerd');
            } else
            {
                $permission = Permission::find($request->id);
                if ($permission)
                {
                    $permission->update(['name' => $data['name'], 'category_id' => $data['category_id']]);
                    return $this->JSONformatSuccessResponse('Updated Successfully');
                } else
                {
                    return $this->JSONformatUnsuccessResponse('Permission not Registerd');
                }
            }
        } else
        {
            $rules = ['name' => 'unique:permissions,name'];
            $validator = Validator::make($data, $rules);
            if ($validator->fails())
            {
                return $this->JSONformatUnsuccessResponse('Name Already Registerd');
            } else
            {
                Permission::create(['name' => $data['name'], 'category_id' => $data['category_id']]);
                return $this->JSONformatSuccessResponse('Created Successfully');
            }
        }
    }

    public function getPermission(Request $request)
    {
        if ($request->id)
        {
            $permission = Permission::find($request->id);
        }
        return $this->JSONformatSuccessResponse($permission);
    }

    public function getPermissions(Request $request)
    {
        $filter = $request->all();
        if (isset($filter))
        {

            $totalrecords = Permission::count();

            $data = Permission::take($filter['rows'])
                    ->skip($filter['first'])
                    ->orderBy($filter['columns'], $filter['sortype'])
                    ->where(function($qu2) use ($filter)
                    {
                        $qu2->orWhere('name', 'like', '%' . $filter['globalFilter'] . '%');
                    })
                    ->get();
            return $this->JSONformatSuccessResponse(compact('data', 'totalrecords'));
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function getAllPermissions(Request $request)
    {
        $permission = array();
        $permission_category = Option_master::where('select_id', 1)->get()->toArray();
        foreach ($permission_category as $key => $value)
        {
            $permission_category[$key]['permission'] = Permission::where('category_id', $value['id'])->get()->toArray();
        }
        return $this->JSONformatSuccessResponse($permission_category);
    }

    public function deletePermission(Request $request)
    {
        if ($request->id)
        {
            $permission = Permission::where('id', $request->id)->delete();
        }
        return $this->JSONformatSuccessResponse('Deleted Successfully');
    }

}
