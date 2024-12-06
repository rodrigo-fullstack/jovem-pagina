<?php

namespace App\Services;

use App\Http\JWT;
use App\Models\Address;
use App\Models\User;
use App\Utils\Validator;
use Exception;
use PDOException;

class AddressService{
    public static function save(array $data, mixed $jwt){
       try{
            if(!$jwt) return ['unauthorized' => "Sorry, we couldn't authenticate you"];
        
            $fields = Validator::validate([
                'rua' => $data['rua'] ?? '',
                'bairro' => $data['bairro'] ?? '',
                'estado' => $data['estado'] ?? '',
                'cep' => $data['cep'] ?? ''
            ]);

            $addressId = Address::save($fields);

            $userFromToken = JWT::validateToken($jwt);
            if(!$userFromToken) {
                return ['unauthorized' => "Please, provide a valid token..."];
            }
            $addressUpdated = User::updateAddress($userFromToken['id_usuario'], $addressId);

            if(!$addressUpdated) return ['error' => "Address not updated!"];

            return "User's address updated successfully!";

       }catch(PDOException $e){
            return Validator::validatePDO($e->getCode());
       } catch (Exception $e){
            return ['error' => $e->getMessage()];
       }

    }

    public static function get(mixed $jwt){
        try{
            if(!$jwt) return ['unauthorized' => "Sorry, we couldn't authenticate you"];
        
            $userFromToken = JWT::validateToken($jwt);
            if(!$userFromToken) {
                return ['unauthorized' => "Please, provide a valid token..."];
            }

            $user = User::find($userFromToken['id_usuario']);
            
            $address = !is_null($user['id_endereco']) ? 
            Address::get($user['id_endereco']) : null;

            if(!$address) return ['error' => "User {$user['nome']} do not have valid address..."];

            return $address;
    
        }catch(PDOException $e){
                return Validator::validatePDO($e->getCode());
        } catch (Exception $e){
                return ['error' => $e->getMessage()];
        }
    
    }       
}
