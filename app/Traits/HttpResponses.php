<?php

namespace App\Traits;

Trait HttpResponses{
    protected function success($data, $message = null, $code = 200){
        return response()->json([
             "status" => "request success",
             "message" => $message,
             "data" => $data,
             ], $code);
    }

    protected function error($data, $message = null, $code = 500){
        return response()->json([
             "status" => "Error",
             "message" => $message,
             "data" => $data,
             ], $code);
    }

    protected function redirect($data, $message = null, $code = 200){
        return response()->json([
             "status" => "request success",
             "message" => $message,
             "data" => $data,
             ], $code);
    }
}