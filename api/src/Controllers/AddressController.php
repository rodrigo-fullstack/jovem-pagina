<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Services\AddressService;

class AddressController{
    public function save(Request $request, Response $response){
        $body = $request::body();

        $jwt = $request::authorization();

        $addressServ = AddressService::save($body, $jwt);

        if(isset($addressServ['unauthorized'])){
            return $response::json([
                "error" => true,
                "success" => false,
                "message" => $addressServ['unauthorized'],
            ], 401);
        }

        if(isset($addressServ['error'])){
            return $response::json([
                "error" => true,
                "success" => false,
                "message" => $addressServ['error'],
            ], 400);
        }

        return $response::json([
            "error" => false,
            "success" => true,
            "data" => $addressServ
        ], 200);
    }

    public function get(Request $request, Response $response){
        $jwt = $request::authorization();

        $addressServ = AddressService::get($jwt);


        if(isset($addressServ['unauthorized'])){
            return $response::json([
                "error" => true,
                "success" => false,
                "message" => $addressServ['unauthorized'],
            ], 401);
        }

        if(isset($addressServ['error'])){
            return $response::json([
                "error" => true,
                "success" => false,
                "message" => $addressServ['error'],
            ], 400);
        }

        return $response::json([
            "error" => false,
            "success" => true,
            "data" => $addressServ
        ], 200);
    }
}