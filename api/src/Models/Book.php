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
    public static function get(int|string $id){
        $bd = new Database();
        $bd->getConnection();

        $bd->query("SELECT * FROM livro WHERE id_livro = :id");

        $bd->bind(":id", $id);

        $bd->execute();

        return $bd->fetchOne();
    }
}