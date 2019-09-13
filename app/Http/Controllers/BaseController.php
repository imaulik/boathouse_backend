<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{

    public function formatSuccessResponse($msg, $data)
    {

        $response = ['status' => 'Success'];
        $response += ['code' => '200'];
        $response += ['msg' => $msg];
        $response += ['data' => $data];
        return $response;
    }

    public function formatUnsuccessResponse($msg)
    {

        $response = ['status' => 'Unsuccess'];
        $response += ['code' => '500'];
        $response += ['msg' => $msg];
        return $response;
    }

    public function JSONformatSuccessResponse($data)
    {
        return response()->json($data, 200);
    }

    public function JSONformatUnsuccessResponse($msg)
    {
        return response()->json($msg, 500);
    }

    public function ApiformatSuccessResponse($msg, $itmsg, $data)
    {

        $response = ['status' => 'Success'];
        $response += ['code' => '200'];
        $response += ['msg' => $msg];
        $response += ['itmsg' => $itmsg];
        $response += ['data' => $data];
        return $response;
    }

    public function ApiformatUnsuccessResponse($msg, $itmsg)
    {

        $response = ['status' => 'Unsuccess'];
        $response += ['code' => '500'];
        $response += ['msg' => $msg];
        $response += ['itmsg' => $itmsg];
        return $response;
    }

}
