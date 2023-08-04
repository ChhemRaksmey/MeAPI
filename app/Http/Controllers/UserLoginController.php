<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserLoginController extends Controller
{

    function login(Request $requst){

        $RESPONSE_STATUS  = "FAIL";
        $RESPONSE_CODE    = "0-1101";
        $RESPONSE_TOKEN   = "";
        $USER_INFO        = [];
        $ERR_MSG          = array();

        $api_request = $requst->all();

        if(!isset($api_request["body"]["DEVICE_IP"]) || empty($api_request["body"]["DEVICE_IP"])) array_push($ERR_MSG, "Device IP Address Missing");
        if(!isset($api_request["body"]["DEVICE_MAC"]) || empty($api_request["body"]["DEVICE_MAC"])) array_push($ERR_MSG, "Device Mac Address Missing");
        if(!isset($api_request["body"]["USER_ID"]) || empty($api_request["body"]["USER_ID"])) array_push($ERR_MSG, "Signon Name Missing");
        if(!isset($api_request["body"]["USER_PASSWORD"]) || empty($api_request["body"]["USER_PASSWORD"])) array_push($ERR_MSG, "Password Missing");

        if(!empty($ERR_MSG)){
            return $this->resposneJson("FAIL", "U-1101", $RESPONSE_TOKEN, $ERR_MSG, $USER_INFO);
        }else{
            
            $USER_INFO = DB::TABLE("C_USER")->FIRST();

            if(!empty($USER_INFO)){
                if($USER_INFO->PASSWORD != $api_request["body"]["USER_PASSWORD"]){
                    return $this->resposneJson($RESPONSE_STATUS, "U-1102", $RESPONSE_TOKEN, ["Credentials Password Incorrect"], $USER_INFO);
                }else{
                    if($USER_INFO->STATUS == "A"){

                        $RESPONSE_TOKEN = $USER_INFO->TOOKEN;

                        if(date('Ymd') >= $USER_INFO->PROFILE_START_DATE && date('Ymd') <= $USER_INFO->PROFILE_END_DATE){
                            if(date('H:i') >= $USER_INFO->PROFILE_START_TIME && date('H:i') <= $USER_INFO->PROFILE_END_TIME){
                                
                            }else{
                                return $this->resposneJson("FAIL", "U-1105", $RESPONSE_TOKEN, ["Login Time During Working Hours"], $USER_INFO);
                            }
                        }else{
                            return $this->resposneJson("FAIL", "U-1104", $RESPONSE_TOKEN, ["Profile User Expired"], $USER_INFO);
                        }

                    }else{
                        return $this->resposneJson("FAIL", "U-1103", $RESPONSE_TOKEN, ["Profile User Locked"], $USER_INFO);
                    }
                }
            }else{
                return $this->resposneJson("FAIL", "U-1102", $RESPONSE_TOKEN, ["Credentials Doesn't Exists"], $USER_INFO);
            }

            return $this->resposneJson("OK", "0-0000", $RESPONSE_TOKEN, [], $USER_INFO);

        }

    }

    function resposneJson($RESPONSE_STATUS, $RESPONSE_CODE, $RESPONSE_TOKEN, $ERR_MSG, $USER_INFO){
        return \Response::json(array(
            "header" => [
                "status"  => $RESPONSE_STATUS,
                "code"    => $RESPONSE_CODE,
                "tooken"  => $RESPONSE_TOKEN,
                "message" => $ERR_MSG,
            ],
            "body" => ($RESPONSE_STATUS=="OK")?$USER_INFO:""
        ));
    }

}



