<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use Validator;
use JWTAuth;

class UserController extends BaseController
{

    public function __construct()
    {
        
    }

    public function checkUserEmail(Request $request)
    {
        $data = $request->all();
        if ($request->id)
        {
            $rules = ['email' => 'required|email|unique:users,email,' . $request->id];
        } else
        {
            $rules = ['email' => 'required|email|unique:users'];
        }
        $validator = Validator::make($data, $rules);
        if ($validator->fails())
        {
            return $this->JSONformatUnsuccessResponse('Email Already Registerd');
        } else
        {
            return $this->JSONformatSuccessResponse('Email Not Registerd');
        }
    }

    public function checkUserUsername(Request $request)
    {
        $data = $request->all();
        if ($request->id)
        {
            $rules = ['username' => 'required|unique:users,username,' . $request->id];
        } else
        {
            $rules = ['username' => 'required|unique:users'];
        }
        $validator = Validator::make($data, $rules);
        if ($validator->fails())
        {
            return $this->JSONformatUnsuccessResponse('Username Already Registerd');
        } else
        {
            return $this->JSONformatSuccessResponse('Username Not Registerd');
        }
    }

    public function saveUser(Request $request)
    {

        $data = $request->all();

        if ($request->id)
        {
            $user = User::find($request->id);
            if ($user)
            {
                $rules = ['email' => 'required|email|unique:users,email,' . $request->id];
                $validator = Validator::make($data, $rules);
                if ($validator->fails())
                {
                    return $this->JSONformatUnsuccessResponse('Email Already Registerd');
                } else
                {
                    $role_name = $data['role'];
                    if ($data['password'] != '**********')
                    {
                        $data['password'] = bcrypt($data['password']);
                    } else
                    {
                        unset($data['password']);
                    }
                    unset($data['role']);
                    $data['remember_token'] = uniqid(mt_rand(), true);
                    $user->update($data);
                    $user->syncRoles($role_name);
                    return $this->JSONformatSuccessResponse('Updated Successfully');
                }
            } else
            {
                return $this->JSONformatUnsuccessResponse('User not Registerd');
            }

            return $this->JSONformatSuccessResponse('Updated Successfully');
        } else
        {
            $rules = ['email' => 'unique:users,email'];
            $validator = Validator::make($data, $rules);
            if ($validator->fails())
            {
                return $this->JSONformatUnsuccessResponse('Email Already Registerd');
            } else
            {
                $role_name = $data['role'];
                $data['password'] = bcrypt($data['password']);
                unset($data['role']);
                $data['remember_token'] = uniqid(mt_rand(), true);
                $user = User::create($data)->assignRole($role_name);
                return $this->JSONformatSuccessResponse('Created Successfully');
            }
        }
    }

    public function getUser(Request $request)
    {
        if ($request->id)
        {
            $user = User::with('status')->find($request->id);
            $user->getRoleNames();
            $user->getPermissionsViaRoles();
            return $this->JSONformatSuccessResponse($user);
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function getUsers(Request $request)
    {
        $filter = $request->all();
        if (isset($filter))
        {
            $query = User::query();
            $query = $query->with(['status', 'roles']);
            $totalrecords = $query->count();


            $query1 = User::query();
            $query1 = $query1->take($filter['rows'])
                    ->skip($filter['first'])
                    ->with(['status', 'roles']);
            $query1 = $query1->where(function($qu2) use ($filter)
                    {
                        $qu2->orWhere('firstname', 'like', '%' . $filter['globalFilter'] . '%');
                        $qu2->orWhere('lastname', 'like', '%' . $filter['globalFilter'] . '%');
                        $qu2->orWhere('email', 'like', '%' . $filter['globalFilter'] . '%');
                    })
                    ->orderBy($filter['columns'], $filter['sortype']);
            $data = $query1->get();


            return $this->JSONformatSuccessResponse(compact('data', 'totalrecords'));
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function getAllUsers(Request $request)
    {
   
            $user = User::role(['Broker','User'])->get()->toArray();
            return $this->JSONformatSuccessResponse($user);
//          if ($request->role)
//        {
//            $user = User::role($request->role)->get()->toArray();
//            return $this->formatSuccessResponse('', $user);
//        } else
//        {
//            return response()->json($this->formatUnsuccessResponse('Please provide parameter'), 500);
//        }
    }

    public function deleteUser(Request $request)
    {
        if ($request->id)
        {
            $user = User::where('id', $request->id)->delete();
            return $this->JSONformatSuccessResponse('Deleted Successfully');
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function changeUserstatus(Request $request)
    {
        $data = $request->all();
        if ($request->id)
        {
            $user = User::find($request->id);
            $user->update(['status_id' => $data['status_id']]);

            return $this->JSONformatSuccessResponse('Status Change Successfully');
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function saveUserRegistration(Request $request)
    {

        $data = $request->all();

        $rules = [
            'email'                 => 'required|email|unique:users',
            'username'              => 'required|unique:users',
            'password'              => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password'];
        $validator = Validator::make($data, $rules);

        if ($validator->fails())
        {
            return response()->json($validator->messages()->first(), 500);
        }

        $password = bcrypt($data['password']);
        if (request('broker') == 1)
        {
            $role_name = 4;
        } else
        {
            $role_name = 5;
        }
        $create_user = User::create([
                    'email'        => $data['email'],
                    'username'     => $data['username'],
                    'broker'       => $data['broker'],
                    'accept_terms' => $data['accept_terms'],
                    'status_id'    => '7',
                    'password'     => $password,
                ])->assignRole($role_name);
        if ($create_user && isset($data['password']) && isset($data['username']))
        {
            $credentials = request(['username', 'password']);
            try
            {
                if (!$token = auth('web')->attempt($credentials))
                {
                    return response()->json('Incorrect Username or Password', 500);
                }
            } catch (JWTException $e)
            {
                return response()->json('could not create token', 500);
            }
            $user = auth('web')->user();
            if ($user->status_id == '7')
            {
                $token = JWTAuth::fromUser($user);
                $user->getRoleNames();
                return $this->formatSuccessResponse('Login Successfully', '');
            } else
            {
                return response()->json('User is Inactive', 500);
            }
        } else
        {
            return response()->json('User Not Register', 500);
        }
    }

    public function UserLoginData(Request $request)
    {
        $data = $request->all();

        $rules = [
            'username' => 'required',
            'password' => 'required'];
        $validator = Validator::make($data, $rules);

        if ($validator->fails())
        {
            return response()->json($validator->messages()->first(), 500);
        }
        if (isset($data['password']) && isset($data['username']))
        {
            $credentials = request(['username', 'password']);
            try
            {
                if (!$token = auth('web')->attempt($credentials))
                {
                    return response()->json('Incorrect Username or Password', 500);
                }
            } catch (JWTException $e)
            {
                return response()->json('could not create token', 500);
            }
            $user = auth('web')->user();
            if ($user->status_id == '7')
            {
                $token = JWTAuth::fromUser($user);
                $user->getRoleNames();
                return $this->formatSuccessResponse('Login Successfully', compact('user', 'token'));
            } else
            {
                return response()->json('User is Inactive', 500);
            }
        } else
        {
            return response()->json('Please Provide Username and Password', 500);
        }
    }

    public function logout()
    {
        \Auth::logout();
        return redirect('/');
    }

}
