<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SystemControlsController extends Controller
{

    function appMain(Request $request){


        return \Response::json(array(
            // "header" => [
                // "status"  => $RESPONSE_STATUS,
                // "code"    => $RESPONSE_CODE,
                // "tooken"  => $RESPONSE_TOKEN,
                // "message" => $ERR_MSG,
            // ],
            "body" => $request->all()["body"]
        ));

    }

    function recordList(Request $request){

    }

    function recordView(Request $request){

    }

    function recordSubmit(Request $request){

    }



}
