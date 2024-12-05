<?php


namespace App\Core;

use App\Http\Request;
use App\Http\Response;
use App\Controllers;

Class Core{
    // URLs
    public static function dispatch(array $routes){
        // dump($routes);

        $url = "/";

        $namespaceController = "App\\Controllers\\";

        $routeFound = false;

        // Se houver url além de /, concatena na $url com essa nova url
        isset($_GET['url']) && $url .= $_GET['url'];

        $url !== "/" && $url = rtrim($url, '/');

        foreach($routes as $route){
            // RegExpression para determinar quando há id na url, convertendo para alfanumérico
            // Está aceitando passar id pelo url
            $pattern = '#^' . preg_replace('/{id}/', '([\w-]+)', $route['path']) . '$#';

            if(preg_match($pattern, $url, $matches)){
                // Impede de retornar o path
                array_shift($matches);
                $routeFound = true;


                // Se o método for diferente da requisição ao servidor, gera um erro 405
                // Corrigir dps erro do método POST passar na requisição
                if($route['method'] !== Request::method()){
                    Response::json([
                        "error" => true,
                        "success" => false,
                        "message" => "Sorry, method not allowed"
                    ], 405);
                    return;
                } 
                // else{
                //     Response::json([
                //         "error" => false,
                //         "success" => true,
                //         "message" => "Você conseguiu passar pelo método {$route['method']}"
                //     ]);
                // }

                //Separa o action yyyyController do método a partir do @
                [$controller, $action] = explode('@', $route['action']);


                // Coleta o nome completo do namespace da controller
                $controller =  $namespaceController . $controller;
                // instancia a controladora
                $extendController = new $controller;

                // Executa o método de acordo com o que foi passado em $action;
                $extendController->$action(new Request, new Response, $matches);

                // dump($matches);
            }
        }

        if(!$routeFound){
            $controller = $namespaceController . 'NotFoundController';
            
            $extendController = new $controller;

            // Injeção de Dependência
            $extendController->index(new Request, new Response);
        }
    }   
}