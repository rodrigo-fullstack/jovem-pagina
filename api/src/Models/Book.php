<?php

namespace App\Models;

class Book{
    public static function save(array $data, int|string $idSeller){
        $bd = new Database();
        $bd->getConnection();

        $bd->query("INSERT into livro(id_vendedor, titulo, descricao, preco)
        VALUES (:id_vendedor, :titulo, :descricao, :preco)
        ");

        $bd->bind(":id_vendedor", $idSeller);
        $bd->bind(":titulo", $data['titulo']);
        $bd->bind(":descricao", $data['descricao']);
        $bd->bind(":preco", $data['preco']);

        $bd->execute();

        return $bd->verifyLastInsertId();
    }
}