<?php

namespace App\Traits;

use Illuminate\Support\Facades\App;

Trait HttpResponses{
    protected function success($data, $message = "Operation successful", $code = 200){
        return response()->json([
             "status" => "request success",
             "code" => $code,
             "message" => $message,
             "data" => $data,
             ], $code);
    }

    protected function error($data, $message = null, $code = 500, $trace = null){
        $common = ["status" => "Error",
                    "code"=> $code,
                    "message" => $message,
                    "data" => $data,
                ];
        if (App::environment("production")){
            return response()->json($common, $code);
        }else{
            return response()->json([...$common, 'stackTrace' => $trace], $code);
        }
    }

    protected function redirect($data, $message = null, $code = 200){
        return response()->json([
             "status" => "request success",
            "code"=> $code,
             "message" => $message,
             "data" => $data,
             ], $code);
    }
}