<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once  __DIR__ . '/../utils.php';
require_once __DIR__ . '/../connection.php';

// // como criar uma função que é definida globalmente?
// // executa como se estivesse no utils

$data = getData('register');
// die(400);
$result = insert($connection, $data);

if($result){
    echo 'Usuário criado com sucesso';
} else{
    echo 'Erro: Não foi possível criar usuário...';
}

function post($name){
    return $_POST[$name] ?? '';
}

function insert(mysqli $connection, stdClass $data){
    if(!$connection){
        return null;
    }
    
    try{
        $sql = "INSERT INTO users (
            nome, email, senha, created_at, updated_at
        ) VALUES (
            '$data->nome', '$data->email', '$data->senha', '$data->created_at', '$data->updated_at'
        )";
        // printData($sql);        
        $result = mysqli_query(
            $connection,
            $sql
        );
        // $connection->prepare()
        if(!$result){
            echo 'Falha na query de insert...';
        }

        return $result;
    } catch(Exception $e){
        printData($e);
    }

}
