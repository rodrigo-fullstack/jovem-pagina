<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once  __DIR__ . '/../utils/utils.php';
require_once __DIR__ . '/../database/connection.php';

$data = getData('login');



// prepared statement em mysqli
$stmt = $connection->prepare(
    "SELECT nome, email, created_at, updated_at FROM users
    WHERE nome = ? AND senha = ?
    "
);
$data->senha = password_hash($data->senha, PASSWORD_BCRYPT);
echo $data->senha;
// $2y$10$Y2OkqMwdyASTgMNgK6RHNOqDgTgzs.pmyV6W8cLnfqOywnEv8p9si
// $2y$10$QZK2fMfKUmQ0LiYcpeCzk.noIseUi9KAJwgpzHlTdAn6VKeiGQYG.

// especifica os tipos na string, depois atribui os dados
$stmt->bind_param('ss', $data->nome, $data->senha);

$stmt->execute();
// printData();
$result = $stmt->get_result();

printData($result->fetch_all());


// $fetch = $stmt->fetch();
// printData($fetch);