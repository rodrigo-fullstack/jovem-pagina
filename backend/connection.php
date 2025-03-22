<?php
require_once __DIR__ . '/./utils.php';
require_once __DIR__ . '/./config.db.php';

// como usar namespace para chamar funções?
// use function utils\printData;
// printData('teste');

try{
    $connection = mysqli_connect(
        DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT
    );
    // inspectObject($connection);
} catch(mysqli_sql_exception $e){
    printData($e);
    echo 'Erro de Conexão com o bd';
}