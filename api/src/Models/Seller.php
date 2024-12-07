<?php

namespace App\Models;

class Seller{
    public static function save(array $data){
        $bd = new Database();
        $bd->getConnection();
        
        $bd->query("INSERT INTO codigo_vendedor (codigo_vendedor)
                    VALUES (:codigo)
        ");

        $bd->bind(":codigo", $data['codigo']);

        $bd->execute();

        // Se houve inserção do código
        if($bd->verifyLastInsertId()){
            $bd->query("INSERT INTO 
            vendedor (nome, email, pessoa, senha, id_codigo_vendedor)
            VALUES (:nome, :email, :pessoa, :senha, :id_codigo_vendedor);
            ");

            $bd->bind(":nome", $data['nome']);
            $bd->bind(":email", $data['email']);
            $bd->bind(":pessoa", $data['pessoa']);
            $bd->bind(":senha", $data['senha']);
            $bd->bind(":id_codigo_vendedor",        
                        $bd->getLastInsertId());
            $bd->execute();
            
            return $bd->verifyLastInsertId();
        }
    }

    public static function auth(array $data){
        $bd = new Database();
        $bd->getConnection();

        $colunas = "id_vendedor, email, senha";
        $bd->query("SELECT $colunas FROM vendedor WHERE email = :email");

        $bd->bind(":email", $data['email']);

        $bd->execute();

        $seller = $bd->fetchOne();

        if(!$seller) return false;

        if(!password_verify($data['senha'], $seller['senha'])){
            return false;
        }

        return [
            "id_vendedor" => $seller['id_vendedor'],
            "email" => $seller['email']
        ];

    }

    public static function updateAddress(
        int|string $idSeller, int|string $idAddress){
        $bd = new Database();
        $bd->getConnection();

        $bd->query("UPDATE vendedor 
        SET id_endereco = :id_endereco
        WHERE id_vendedor = :id_vendedor");

        $bd->bind(":id_endereco", $idAddress);
        $bd->bind(":id_vendedor", $idSeller);

        $bd->execute();

        return $bd->getAffectedRows() < 1 ? false : true;
        
    }

    public static function find(int|string $id){
        $bd = new Database();
        $bd->getConnection();

        $colunas = "id_vendedor, nome, email, pessoa, id_codigo_vendedor, id_endereco";

        $bd->query("SELECT $colunas FROM vendedor 
        WHERE id_vendedor = :id_vendedor
        ");

        $bd->bind(":id_vendedor", $id);

        $bd->execute();

        return $bd->fetchOne();

    }
}