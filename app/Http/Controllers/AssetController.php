<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AssetController extends Controller
{

    function recordList(Request $request){

        $RESPONSE_DATA = DB::TABLE("c_asset_register")->SELECT()->GET();

        return $this->resposneJson("OK", "0-0000", $RESPONSE_TOKEN, $RESPONSE_DATA, $USER_INFO);

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
