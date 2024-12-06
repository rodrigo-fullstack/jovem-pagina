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
}