<?php
declare(strict_types=1);

namespace App\Http;

class Routes{
    // Atributo estático que armazena as rotas
    private static array $routes = [];

    // Função para acessar get
    public static function get(string $path, string $action){
        self::$routes[] = [
            "path" => $path, 
            "action" => $action,
            "method" => "GET"
        ];

    }

    // Função para acessar post
    public static function post(string $path, string $action){
        self::$routes[] = [
            "path" => $path,
            "action" => $action,
            "method" => "POST"
        ];
    }

    // Função para acessar put (ou substituição)
    public static function put(string $path, string $action){
        self::$routes[] = [
            "path" => $path,
            "action" => $action,
            "method" => "PUT"
        ];
    }

    // Função para acessar delete
    public static function delete(string $path, string $action){
        self::$routes[] = [
            "path" => $path,
            "action" => $action,
            "method" => "DELETE"
        ];
    }

    // Retorna as rotas definidas
    public static function routes(){
        return self::$routes;

    }


}