<?php

use App\Http\Routes;

// Determinando rotas com os métodos estáticos
// Padronização do Action é o nome da controladora separada por @ e o método da controladora
Routes::get("/", "HomeController@index");
Routes::get("/index", "HomeController@index");
Routes::get("/users/find", "UserController@find");
Routes::get('/users/{id}/fetchOne', "UserController@fetchOne");
Routes::get('/users/fetchAll', "UserController@fetchAll");
Routes::post('/users/auth', "UserController@auth");
Routes::post("/users/save", "UserController@save");
Routes::put('/users/update', "UserController@update");
Routes::delete('/users/{id}/delete', "UserController@delete");

// $routes = Routes::routes(');