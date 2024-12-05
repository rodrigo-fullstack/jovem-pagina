<?php

namespace App\Models;

class Address{
    public static function save(array $data){
        $bd = new Database();
        $bd->getConnection();

        $bd->query("
            INSERT INTO endereco(rua, bairro, estado, cep) 
            VALUES(:rua, :bairro, :estado, :cep)
        ");

        $bd->bind(":rua", $data['rua']);
        $bd->bind(":bairro", $data['bairro']);
        $bd->bind(":estado", $data['estado']);
        $bd->bind(":cep", $data['cep']);

        $bd->execute();

        return $bd->getLastInsertId();
    }
}