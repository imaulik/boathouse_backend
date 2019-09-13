<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Str;
use JWTAuth;
use Validator;
use File;
use Illuminate\Support\Facades\Response;

class AuthController extends BaseController
{

    public function __construct()
    {
        // $this->middleware('auth:web', ['except' => ['login']]);
    }

    public function logout(Request $request)
    {
        $data = $request->all();
        if (auth('web'))
        {
            auth('web')->logout(true);
            return $this->JSONformatSuccessResponse('Logout Successfully');
        } else
        {
            return $this->JSONformatUnsuccessResponse('Token is Invalid');
        }
    }

    public function login(Request $request)
    {

        $data = $request->all();
        $permissions = array();
        if (isset($data['password']) && isset($data['email']))
        {
            $credentials = request(['email', 'password']);

            try
            {
                if (!$token = auth('web')->attempt($credentials))
                {
                    return $this->JSONformatUnsuccessResponse('Unauthorized');
                }
            } catch (JWTException $e)
            {
                return $this->JSONformatUnsuccessResponse('could_not_create_token');
            }


            $user = auth('web')->user();
            if ($user->status_id == '7')
            {
                $token = JWTAuth::fromUser($user);
                $user->getRoleNames();
                $user->getPermissionsViaRoles();
                return $this->JSONformatSuccessResponse(compact('user', 'token'));
            } else
            {
                return $this->JSONformatUnsuccessResponse('User is Inactive');
            }
        } else
        {
            return $this->JSONformatUnsuccessResponse('Email and Password Please Provide');
        }
    }

    public function register(Request $request)
    {
        $data = $request->all();

        if (isset($data['password']) && isset($data['email']) && isset($data['role']) && isset($data['firstname']) && isset($data['lastname']))
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
                $comapny = $data['company'];
                unset($data['company']);
                $data['remember_token'] = uniqid(mt_rand(), true);
                $data['status_id'] = 7;
                $user = User::create($data)->assignRole($role_name);
                if ($user)
                {
                    $comapny['user_id'] = $user->id;
                    Company::create($comapny);
                }
                return $this->JSONformatSuccessResponse('Created Successfully');
            }
        }
    }

    public function forgetpassword(Request $request)
    {
        $data = $request->all();
        if (isset($data['email']))
        {
            $user = User::where('email', $request->email)->first()->toArray();
            $url = config(app . url) . $user->remember_token;
//            $myViewData = View::make('emails.forget_admin_password', ['email' => $request->only('email'), 'level' => 'success', 'outroLines' => [0 => ''], 'actionText' => 'Reset Password', 'actionUrl' => $url, 'introLines' => [0 => 'Click the button to Reset your Password.']])->render();
//            if (app('App\Http\Controllers\EmailController')->sendMail($credentials['email'], 'Password Reminder', $myViewData))
//            {
            return $this->JSONformatSuccessResponse('Your password has been reset. Please check your email.');
//            } else
//            {
//                return response()->json($this->formatUnsuccessResponse('Something Went Wrong.', ''), 500);
//            }
        }
    }

    public function get_forgotten_user(Request $request)
    {
        $data = $request->all();
        if (isset($data['user_token']))
        {
            $user = User::where('remember_token', $request->user_token)->first();
            if (!empty($user))
            {
                return $this->JSONformatSuccessResponse($user);
            } else
            {
                return $this->JSONformatUnsuccessResponse('Link is Invalid');
            }
        }
    }

    public function resetPassword(Request $request)
    {
        $data = $request->all();

        if (isset($data['remember_token']) && isset($data['email']))
        {
            $user = User::where('email', $request->email)->where('remember_token', $request->remember_token)->first()->toArray();

            if (isset($user['id']))
            {
                $user = User::find($user['id']);
                $tmpdata['password'] = bcrypt($data['password']);
                $tmpdata['remember_token'] = uniqid(mt_rand(), true);
                $user->update($tmpdata);
//                $myViewData = View::make('emails.password_change_success', ['email' => $request->only('email'), 'level' => 'success', 'outroLines' => [0 => ''], 'introLines' => [0 => 'Your Password has been changed successfully .']])->render();
//                if (app('App\Http\Controllers\EmailController')->sendMail($credentials['email'], 'Password Reminder', $myViewData))
//                {
                return $this->JSONformatSuccessResponse('Congratulations, you have successfully changed your password.');
//                } else
//                {
//                    return response()->json($this->formatUnsuccessResponse('Something Went Wrong.', ''), 500);
//                }
            }
        }
    }

    public function activeAccount(Request $request)
    {
        $data = $request->all();
        if (isset($request->user_token))
        {
            $user = User::where('remember_token', $request->user_token)->first();
            if (isset($user['id']))
            {
                $user->update(['status_id' => 7, 'remember_token' => Str::random(30)]);
//                $myViewData = View::make('emails.account_active_success', ['email' => $user->getEmail(), 'level' => 'success', 'outroLines' => [0 => ''], 'introLines' => [0 => 'Your Account Activate successfully .']])->render();
//                if (app('App\Http\Controllers\EmailController')->sendMail($user->getEmail(), 'Account Active', $myViewData))
//                {
                return $this->JSONformatSuccessResponse('User Activate Successfully Send mail to User');

//                } else
//                {
//                    return response()->json(['error' => "Something Went Wrong."], 500);
//                }
            } else
            {
                return $this->JSONformatUnsuccessResponse('Link is Invalid');
            }
        }
    }

    public function getFile($filename)
    {
        // todo check authentiation and other conditions

        $path = storage_path('app/' . $filename);
        if (!File::exists($path))
        {
            abort(404);
        }
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }

}
