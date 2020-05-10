<?php

namespace App\Traits;

trait ApiResponse{

    public function successResponse($date, $code = 200, $msj = ''){
    return response()->json(array("data" => $date, "code" => $code, "msj" => $msj),$code);
    }

    public function errorResponse($date, $code = 500, $msj = ''){
        return response()->json(array("data" => $date, "code" => $code, "msj" => $msj),$code);
        }

}