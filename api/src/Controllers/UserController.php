<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Services\UserService;

class UserController{
    public function auth(Request $request, Response $response){
        // Escutando requisição body...
        $body = $request::body();

        // Recebendo usuário do UserService
        $usrServ = UserService::auth($body);

        // dump($usrServ);
        // dump($usrServ['error']);
        // dump(isset($usrServ['error']));

        if(isset($usrServ['unauthorized'])){
            return $response::json([
                'error' => true,
                'success' => false,
                'error-msg' => $usrServ['unauthorized']
            ], 401);
        }

        if(isset($usrServ['error'])){
            return response::json([
                "error" => true,
                "success" => false,
                "error-msg" => $usrServ['error']
            ], 400
            );
        }

        return response::json([
            "error" => false,
            "success" => true,
            "jwt" => $usrServ
        ]);
    }
    
    public function find(Request $request, Response $response){
 
        $jwt = $request::authorization();
     
        $usrServ = UserService::find($jwt);
    
        if(isset($usrServ['unauthorized'])){
            return $response::json([
                'error' => true,
                'success' => false,
                'error-msg' => $usrServ['unauthorized']
            ], 401);
        }

        if(isset($usrServ['error'])){
            return $response::json(
                [
                "error" => true,
                "success" => false,
                "error-msg" => $usrServ['error']
                ], 400
            );
        }
    
        return $response::json($usrServ);
    
    }

    // public function fetchAll(Request $request, Response $response){
        
    //     $authorization = $request::authorization();
        
    //     $usrServ = UserService::fetchAll($authorization);

    //     if(isset($usrServ['error'])){
    //         return $response::json(
    //             [
    //             "error" => true,
    //             "success" => false,
    //             "error-msg" => $usrServ['error']
    //             ], 400
    //         );
    //     }

    //     return $response::json($usrServ);

    // }
    
    public function save(Request $request, Response $response){
        // Escuta pelo envio de requisições de body
        $body = $request::body();

        // Dados para serem cadastrados são enviados para o service para serem verificados
        $usrServ = UserService::save($body);

        if(isset($usrServ['error'])){
            // Erro 400 houve erro na requisição (BAD_REQUEST)
            return $response::json([
                "error" => true,
                "success" => false,
                "error-msg" => $usrServ['error']
            ], 400);
        }

        // Status 201 determina que foi criado novo recurso com sucesso
        $response::json(
            [
            "error" => false,
            "success" => true,
            "data" => $usrServ], 
            201
        );
    }

    public function update(Request $request, Response $response){
        $body = $request::body();

        $jwt = $request::authorization();

        $usrServ = UserService::update($jwt, $body);

        if(isset($usrServ['unauthorized'])){
            return $response::json([
                'error' => true,
                'success' => false,
                'error-msg' => $usrServ['unauthorized']
            ], 401);
        }

        if(isset($usrServ['error'])){
            return $response::json([
                "error" => true,
                "success" => false,
                "error-msg" => $usrServ['error']
            ], 400);
        }

        return $response::json([
            "error" => false,
            "success" => true,
            "message" => "User has been updated successfully"
        ], 200);
    }

    public function delete(Request $request, Response $response){
        $jwt = $request::authorization();

        $id = $request::requestUri()[3];
        // Outra forma é colocar o id como array e receber o dado de array $id[0] devido às chaves implementadas em main.php

        $usrServ = UserService::delete($jwt, $id);

        if(isset($usrServ['unauthorized'])){
            return $response::json([
                'error' => true,
                'success' => false,
                'error-msg' => $usrServ['unauthorized']
            ], 401);
        }

        if(isset($usrServ['error'])){
            return $response::json([
                'error' => true,
                'success' => false,
                'error-msg' => $usrServ['error']
            ], 400);
        } 

        return $response::json([
            'error' => false,
            'success' => true,
            'message' => "User has been deleted successfully"
        ], 200);
    }

}