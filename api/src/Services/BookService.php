<?php

namespace App\Services;

use App\Http\JWT;
use App\Models\Book;
use App\Utils\Validator;
use Exception;

class BookService{
    public static function save(array $data, mixed $jwt){
        try{
            if(!$jwt) return ['unauthorized' => "Sorry, we couldn't authenticate you"];
            
            $userFromToken = JWT::validateToken($jwt);
            if(!$userFromToken) return ['unauthorized' => "Please provide a valid token..."];

            if(!isset($userFromToken['id_vendedor'])) return ['unauthorized' => "You are not a seller..."];

            $fields = Validator::validate([
                "titulo" => $data['titulo'],
                "descricao" => $data['descricao'],
                "preco" => $data['preco']
            ]);

            $book = Book::save($fields, $userFromToken['id_vendedor']);
        
            if(!$book) return ['error' => "Book not registered!"];

            return "Book registered successfully";
        } catch(Exception $e){

            return ['error' => $e->getMessage()];
        }
    }

    public static function get(int|string $idBook, mixed $jwt){
            if(!$jwt) return ['unauthorized' => "Sorry, we couldn't authenticate you"];
            
            $userFromToken = JWT::validateToken($jwt);
            if(!$userFromToken) return ['unauthorized' => "Please provide a valid token..."];

            $book = Book::get($idBook);
    }
}