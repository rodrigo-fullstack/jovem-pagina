<?php
declare(strict_types = 1);

namespace App\Utils;

// Serve para validar os dados recebidos
class Validator{
    public static function validate(array $fields){

        // Para cada campo em campos com seu devido valor
        foreach($fields as $field => $value){
            // Se não é vazia e elimina todos os espaços em branco com trim
            if(empty(trim($value))){
                throw new \Exception("The field {$field} is required");
            }
        }

        return $fields;
    }

    public static function validatePDO($codeNum){
        $dsnError = "There was an error with your PDO...";
        $sintaxError = "There was an error with your SQL Sintax... ";
        $msgError = match($codeNum){
            2002 => ["error" => "$dsnError It can be your dsn host or db port."],
            1049 => ["error" => "$dsnError It can be your dbname."],
            "42S02" => ["error" => "$sintaxError It can be your table name."],
            "42000" => ["error" => "$sintaxError It can be your sql statement."],
            "42S22" => ["error" => "$sintaxError It can be your table attributes that aren't correct."],
            "HY093" => ["error" => "$sintaxError It can be a problem with the param's binding."],
            "23000" => ["error" => "Problem with the sent value, maybe it was null or repeat of an unique key."],
            0 => ["error" => "$dsnError Check if your dbms is correct."],
            $codeNum => ["error" => "Code error: {$codeNum}."]

        };

        return $msgError;
    }
}