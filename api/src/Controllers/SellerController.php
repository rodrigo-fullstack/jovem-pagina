<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Services\SellerService;

class SellerController{
    public function save(Request $request, Response $response){
        $body = $request::body();

        $sellerServ = SellerService::save($body);

        if(isset($sellerServ['error'])){
            return $response::json([
                "error" => true,
                "success" => false,
                "message" => $sellerServ['error']
            ], 400);
        }

        return $response::json([
            "error" => false,
            "success" => true,
            "message" => $sellerServ
        ]);
    }
}