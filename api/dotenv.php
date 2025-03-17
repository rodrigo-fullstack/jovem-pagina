<?php

require_once "vendor/autoload.php";
use Dotenv\Dotenv;

// Carregando arquivo dotenv
$dotenv = Dotenv::createImmutable('.'); //Procurando no diretório atual
$dotenv->load();

// echo $_ENV['KEY'];