<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserLoginController extends Controller
{
    function login(Request $requst){

        $ERR_MSG = array();

        if(!isset($requst->TOOKEN) || empty($requst->TOOKEN)) array_push($ERR_MSG, "Token Missing");
        if(!isset($requst->DEVICE_IP) || empty($requst->DEVICE_IP)) array_push($ERR_MSG, "Device IP Address Missing");
        if(!isset($requst->DEVICE_MAC) || empty($requst->DEVICE_MAC)) array_push($ERR_MSG, "Device Mac Address Missing");
        if(!isset($requst->USER_ID) || empty($requst->USER_ID)) array_push($ERR_MSG, "Signon Name Missing");
        if(!isset($requst->USER_PASSWORD) || empty($requst->USER_PASSWORD)) array_push($ERR_MSG, "Password Missing");


        if(sizeof($ERR_MSG)>0){

            return \Response::json(array(
                "header" => [
                    "status" => "FAIL",
                    "code" => "4101",
                    "tooken" => "",
                    "message" => $requst->all(),
                    "response" => $ERR_MSG
                ],
            ));

        }else{
            
            $USER_INFO = DB::TABLE("C_USER")->FIRST();

            return \Response::json(array(
                "header" => [
                    "status" => "OK",
                    "code" => "",
                    "tooken" => "",
                    "message" => "",
                ],
                "body" => $USER_INFO
            ));

        }

    }

}



