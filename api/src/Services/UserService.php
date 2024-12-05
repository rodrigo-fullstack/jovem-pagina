<?php
declare(strict_types=1);

namespace App\Services;

use App\Http\JWT;
use App\Models\User;
use App\Utils\Validator;
use Exception;
use PDOException;
use Throwable;

// Realiza a aplicação das regras de negócio sobre os dados, evitando que a controladora fique poluída
class UserService{
    // Recebe somente ids inteiros
    public static function find(mixed $jwt){
        try{
            if(!$jwt) return ["unauthorized" => "Sorry, we couldn't authenticate you..."];
            
            // Recebe o token do jwt
            
            $userFromJwt = JWT::validateToken($jwt);

            if(!$userFromJwt) return ["unauthorized" => "Please, provide a valid token..."];

            $user = User::find($userFromJwt['id_usuario']);

            if(!$user) return ['error' => "Sorry, we couldn't find your data..."];

            return $user;
        }catch(PDOException $e){
            return Validator::validatePDO($e->getCode());
            // return Validator::validatePDO($e->getCode());
        } catch(Exception $e){
            return ["error" => $e->getMessage()];
        }
        
        // try{
        //     if(!$authorization) return "Sorry, user can't access this resource.";

        //     return $users = User::fetchAll();

        // } catch(PDOException $e){
        //     echo "Passei no catch do PDO...";
        //     return Validator::validatePDO($e->getCode());
        //     // return Validator::validatePDO($e->getCode());
        // } catch(Exception $e){
        //     return ["error" => $e->getMessage()];
        // }
    }
    
    public static function auth(array $data){
        try{
            $fields = Validator::validate([
                "email" => $data['email'] ?? '',
                "senha" => $data['senha'] ?? ''
            ]);

            $user = User::auth($fields);

            // dump($user);

            // Verificar depois como enviar erro 401 para usuário não autorizado...
            if(!$user) return ['unauthorized' => "Sorry, we could not authenticate you..."];

            return JWT::generate([
                "id_usuario" => $user['id_usuario'],
                "email" => $user['email']
            ]);
        }
        catch(PDOException $e){
            return Validator::validatePDO($e->getCOde());
        } 
        catch(Exception $e){
            return ["error" => $e->getMessage()];
        }
    }

    public static function save(array $data){
        try{
            // Campos são validados para serem persistidos no bd
            // Envia senha criptografada para o validator
            $fields = Validator::validate([
                "nome" => $data['nome'] ?? '',
                "email" => $data['email'] ?? '',
                "senha" => $data['senha'] ?? '',
                "data_nasc" => $data['data_nasc'] ?? '',
                "cpf" => $data['cpf'] ?? ''
            ]);

            $fields['senha'] = password_hash($fields['senha'], PASSWORD_BCRYPT);
            // Cadastro do dado, retorna se houve inserção ou não
            // Caso houve erro no pdo, gera erro no catch
            $user = User::save($fields);

            // dump($user);

            if(!$user) return "Sorry, User has not been created...";
            
            return "User has been created succesfully";
        }
        catch(PDOException $e){
            return Validator::validatePDO($e->getCode());
        }
        catch(Exception $e){
            return ["error" => $e->getMessage()];
        }
    }

    public static function update(mixed $jwt, array $data){
        try{
            if(!$jwt) return ['unauthorized' => "Sorry, we couldn't authenticate you... "];

            // Implementar lógica para não precisar reescrever os dados do banco para dados vazios.
            $fields = Validator::validate([
                'email' => $data['email'],
                'senha' => $data['senha']
            ]);

            // Passando senha para criptografia
            $fields['senha'] = password_hash($fields['senha'], PASSWORD_BCRYPT);

            // Validando token jwt 
            $userFromJwt = JWT::validateToken($jwt);

            if(!$userFromJwt) return ['unauthorized' => "Please, provide a valid token..."];

            $user = User::update($userFromJwt['id_usuario'], [
                'email' => $fields['email'],
                'senha' => $fields['senha']
            ]);

            if(!$user) return ['error' => "Sorry, we couldn't update your user..."];

            return "Your user has been updated succesfully";
        }catch(PDOException $e){
            return Validator::validatePDO($e->getCode());
        }catch(Exception $e){
            return ['error' => $e->getMessage()];
        }
    }

    // Recebe o Id da URL
    public static function delete(mixed $jwt, int|string $id){
        try{
            if(!$jwt) return ['unauthorized' => "Sorry, we couldn't authenticate you..."];

            if(!JWT::validateToken($jwt)) return ['unauthorized' => 'Please, provide a valid token...'];

            $user = User::delete($id);

            if(!$user) return ['error' => "User not find in the database..."];

            return "User has been deleted successfully";
        }catch(PDOException $e){
            return Validator::validatePDO($e->getCode());

        }catch(Exception $e){
            return ['error' => $e->getMessage()];

        }
    }


}