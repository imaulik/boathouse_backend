<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Option_master;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Validator;

class RoleController extends BaseController
{

    public function __construct()
    {
        
    }

    public function saveRole(Request $request)
    {
        $data = $request->all();
        if ($request->id)
        {
            $rules = ['name' => 'required|unique:roles,name,' . $request->id];
            $validator = Validator::make($data, $rules);
            if ($validator->fails())
            {
                return response()->json($this->formatUnsuccessResponse('Role Name Already Registerd'), 500);
            } else
            {
                $role = Role::find($request->id);
                if ($role)
                {
                    $permission = array();
                    foreach ($data['permissions'] as $key => $value)
                    {
                        foreach ($value['permission'] as $k => $v)
                        {
                            if (isset($v['is_used']) && $v['is_used'])
                            {
                                $permission[] = $v['name'];
                            }
                        }
                    }
                    if ($permission)
                    {
                        $role->update(['name' => $data['name']]);
                        $role->syncPermissions($permission);
                    }
                    return $this->JSONformatSuccessResponse('Updated Successfully');
                } else
                {
                    return $this->JSONformatUnsuccessResponse('Role not Registerd');
                }
            }
        } else
        {
            $rules = ['name' => 'unique:roles,name'];
            $validator = Validator::make($data, $rules);
            if ($validator->fails())
            {
                return $this->JSONformatUnsuccessResponse('Name Already Registerd');
            } else
            {
                $permission = array();
                foreach ($data['permissions'] as $key => $value)
                {
                    foreach ($value['permission'] as $k => $v)
                    {
                        if (isset($v['is_used']) && $v['is_used'])
                        {
                            $permission[] = $v['name'];
                        }
                    }
                }
                if ($permission)
                {
                    Role::create(['name' => $data['name']])
                            ->givePermissionTo($permission);
                }
                return $this->JSONformatSuccessResponse('Created Successfully');
            }
        }
    }

    public function getRole(Request $request)
    {
        if ($request->id)
        {
            $role = Role::find($request->id);
            $role->givePermissionTo();
        }
        return $this->JSONformatSuccessResponse($role);
    }

    public function getRolePermission(Request $request)
    {
        if ($request->id)
        {
            $role = Role::find($request->id);
            $role->givePermissionTo();

            $permission = array();
            $permission_category = Option_master::where('select_id', 1)->get()->toArray();
            foreach ($permission_category as $key => $value)
            {
                $permission_category[$key]['permission'] = Permission::where('category_id', $value['id'])->get()->toArray();
            }
            foreach ($permission_category as $key => $value)
            {
                foreach ($value['permission'] as $k => $v)
                {
                    foreach ($role['permissions'] as $rk => $rv)
                    {
                        if ($rv['id'] == $v['id'])
                        {
                            $permission_category[$key]['permission'][$k]['is_used'] = 1;
                        }
                    }
                }
            }
           
            unset($role['permissions']);
            $role['permissions'] = $permission_category;
            return $this->JSONformatSuccessResponse($role);
        }
    }

    public function getRoles(Request $request)
    {
        $filter = $request->all();
        if (isset($filter))
        {

            $totalrecords = Role::count();

            $data = Role::take($filter['rows'])
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

    public function getAllRoles(Request $request)
    {
        $role = Role::get()->toArray();
        return $this->JSONformatSuccessResponse($role);
    }

    public function deleteRole(Request $request)
    {
        if ($request->id)
        {
            $role = Role::where('id', $request->id)->delete();
        }
        return $this->JSONformatSuccessResponse('Deleted Successfully');
    }

}
