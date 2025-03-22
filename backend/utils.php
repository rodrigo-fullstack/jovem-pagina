<?php
function getData(string $from){
    $data = new stdClass();
    foreach($_POST as $key => $value){
        $data->$key = $value;
    }

    if(!required($data)){ 
        echo 'Erro: Todos os campos devem ser preenchidos.';
        die(400);
    }

    if($from === 'register'){
        $data->senha = password_hash(
            password: $data->senha, 
            algo: PASSWORD_BCRYPT
        );
        
        $data->created_at = date('Y-m-d');
        $data->updated_at = date('Y-m-d');
    }

    return $data;
}


function required($data){
    foreach($data as $value){
        if(empty($value)){
            return false;
        }
    }
    return true;
}

function printData($data){
    echo '<pre>';
    print_r($data);
}

function inspectObject($object){
    $reflectionAPI = new ReflectionClass($object);
    printData($reflectionAPI->getProperties());
    printData($reflectionAPI->getMethods());
}