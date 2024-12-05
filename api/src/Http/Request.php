<?php


namespace App\Http;

Class Request{
    public static function method(){
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function body(){
        // Recupera o json caso haja envio de dados, caso não haja retorna um array vazio
        $json = json_decode(file_get_contents('php://input'), true) ?? [];

        // 
        $data = match(self::method()){
            'GET' => $_GET,
            'POST', 'PUT', 'DELETE' => $json
        };
        
        return $data;
    }

    public static function authorization(){
        $headers = getallheaders();

        if(!isset($headers['Authorization'])) return false;

        $authorization = $headers['Authorization'];
        
        $authorization = explode(" ", $authorization);

        // dump($authorization);

        if(count($authorization) !== 2) return false;
        
        return $authorization[1] ?? '';
    }

    public static function requestUri(){
        $url = $_SERVER["REQUEST_URI"];

        $urlPartials = explode('/', $url);

        return $urlPartials;
    }
}