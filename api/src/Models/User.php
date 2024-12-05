<?php

namespace App\Models;

use App\Models\Database;
use PDOException;
use Throwable;

class User{
    public static function fetchAll($authorization){

        $bd = new Database();

        $bd->getConnection();

        $bd->query("SELECT * FROM usuario");

        $bd->execute();

        // dump($bd->fetchAll());

        // Retorna um array contendo todos os elementos...
        return $bd->fetchAll();
    }

    public static function find(int|string $id){
        return self::fetchOne($id);
    }

    public static function fetchOne(int|string $id){
        $bd = new Database();

        $bd->getConnection();

        // Corrigindo problema do atributo id (correto: id_usuario)
        $bd->query("SELECT * FROM usuario WHERE id_usuario = :id_usuario");
        $bd->bind(":id_usuario", $id);

        $bd->execute();

        return $bd->fetchOne();
    }

    public static function save(array $data){
        $bd = new Database();
        
        // Realiza a conexão pelo dbh do db e retorna como valor true ou uma mensagem de erro
        $bd->getConnection();

        // Se houve a conexão...
        // Consulta de inserção...
        $bd->query("
            INSERT INTO usuario(nome, email, senha, data_nasc, cpf)
            VALUES(:nome, :email, :senha, :data_nasc, :cpf)
        ");

        // Vincula os parâmetros determinados na inserção
        $bd->bind(':nome', $data['nome']);
        $bd->bind(':email', $data['email']);
        $bd->bind(':senha', $data['senha']);
        $bd->bind(':data_nasc', $data['data_nasc']);
        $bd->bind(':cpf', $data['cpf']);

        // Execução da consulta
        $bd->execute();
        
        // Retorna se houve última inserção de ID, caso contrário é um false
        return $bd->lastInsertId();
        
    }

    public static function auth(array $data){
        $bd = new Database();

        $bd->getConnection();
        
        $stmt = $bd->query("SELECT * FROM usuario WHERE email = :email");
        $bd->bind(":email", $data['email']);

        $stmt->execute();
        
        // Verificar se recuperou dados
        if($stmt->rowCount() < 1) return false;
        
        $user = $bd->fetchOne();

        // dump($user);
        if(!password_verify($data['senha'], $user['senha'])){
            return false;  
        } 

        return [
            "id_usuario" => $user['id_usuario'],
            "email" => $user['email']
        ];
    }

    public static function update(int|string $id, array $data){
        $bd = new Database();

        $bd->getConnection();

        $stmt = $bd->query("UPDATE usuario
        SET email = :email, senha = :senha
        WHERE id_usuario = :id
        ");

        $bd->bind(':id', $id);

        $bd->bind(':email', $data['email']);

        $bd->bind(':senha', $data['senha']);
        
        $bd->execute();
        
        // Se houve linhas afetadas, ou seja, houve update: (vem depois do execute)
        return $bd->checkAffectedRows() < 1 ? false : true;


    }   

    public static function delete($id){
        $bd = new Database();

        $bd->getConnection();

        $bd->query("DELETE FROM usuario WHERE id_usuario = :id");

        $bd->bind(":id", $id);

        $bd->execute();

        return $bd->checkAffectedRows() < 1 ? false : true;

    }
    
}