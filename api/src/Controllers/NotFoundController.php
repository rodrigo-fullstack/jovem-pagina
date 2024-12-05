<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;

class NotFoundController{

    public function index(Request $request, Response $response){
        Response::json(
            [
            "error" => true,
            "success" => false,
            "message" => "404, Route not found"], 404
        );
        return;
    }   
}
