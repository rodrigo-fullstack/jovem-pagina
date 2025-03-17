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

Routes::post("/address/save", "AddressController@save");
Routes::get("/address/get", "AddressController@get");

Routes::post("/seller/save", "SellerController@save");
Routes::post("/seller/auth", "SellerController@auth");

Routes::post("/book/save", "BookController@save");
Routes::get("/book/get/{id}", "BookController@get");
// $routes = Routes::routes(');