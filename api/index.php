<?php

require_once('vendor/autoload.php');

// Requisitando arquivo de rotas
require_once(__DIR__ . '/src/routes/main.php');

use App\Core\Core;
use App\Http\Routes;
// use App\Models\Database;

// Exibindo rotas de routes/main.php
Core::dispatch(Routes::routes());


// print_r(json_encode($_GET, JSON_PRETTY_PRINT));