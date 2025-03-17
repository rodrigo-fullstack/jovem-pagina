<?php

namespace App\Services;

use App\Http\JWT;
use App\Models\Seller;
use App\Utils\Validator;
use Exception;
use PDOException;

class SellerService{
    public static function save(array $data){
        try{
            $fields = Validator::validate([
                "nome" => $data['nome'] ?? '',
                "email" => $data['email'] ?? '',
                "pessoa" => $data['pessoa'] ?? '',
                "codigo" => $data['codigo'] ?? '',
                "senha" => $data['senha'] ?? ''
            ]);

            $fields['senha'] = password_hash($fields['senha'], PASSWORD_BCRYPT);

            $seller = Seller::save($fields);

            if(!$seller) return ['error' => "Seller not registered!"];

            return "Seller registered successfully!";
        } catch(PDOException $e){
            return Validator::validatePDO($e->getCode());
        } catch(Exception $e){
            return ['error' => $e->getMessage()];
        }

    }

    public static function auth(array $data){
        try{
            $fields = Validator::validate([
                "email" => $data['email'] ?? '',
                "senha" => $data['senha'] ?? ''
            ]);

            $seller = Seller::auth($fields);

            if(!$seller) return ['unauthorized' => "Email or password are incorrect..."];

            return JWT::generate([
                "id_vendedor" => $seller['id_vendedor'],
                "email" => $seller['email']
            ]);

        } catch(PDOException $e){
            return Validator::validatePDO($e->getCode());
        } catch(Exception $e){
            return ['error' => $e->getMessage()];
        }

    }
}