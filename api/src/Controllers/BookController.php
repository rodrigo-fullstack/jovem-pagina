<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Services\BookService;
use App\Services\UserService;

class BookController{

    public function save(Request $request, Response $response){
        $body = $request::body();

        $jwt = $request::authorization();

        $bookServ = BookService::save($body, $jwt);

        if(isset($bookServ['unauthorized'])){
            return $response::json([
                "error" => true,
                "success" => false,
                "message" => $bookServ['unauthorized']
            ], 401);
        }

        if(isset($bookServ['error'])){
            return $response::json([
                "error" => true,
                "success" => false,
                "message" => $bookServ['error']
            ], 400);
        }

        return $response::json([
            "error" => false,
            "success" => true,
            "message" => $bookServ
        ], 201);
    }

    public function get(Request $request, Response $response){
        $idBook = $request::requestUri()[4];
        
        $jwt = $request::authorization();

        $bookServ = BookService::get($idBook, $jwt);

        if(isset($bookServ['error'])){
            return $response::json([
                "error" => true,
                "success" => false,
                "message" => $bookServ
            ], 400);
        }
    }
}