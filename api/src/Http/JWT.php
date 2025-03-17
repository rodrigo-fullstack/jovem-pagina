<?php

namespace App\Http;
require "dotenv.php";

class JWT{

    public static function generate(array $data = []){
        $header = json_encode(["typ" => "JWT", "alg" => "HS256"]);

        $payload = json_encode($data);

        $base64UrlHeader = self::base64url_encode($header);
        $base64UrlPayload = self::base64url_encode($payload);

        $signature = self::signature($base64UrlHeader, $base64UrlPayload);

        $jwt = $base64UrlHeader . '.' . $base64UrlPayload . '.' . $signature;
        
        return $jwt;
    }

    public static function signature($header, $payload){
        $signature = hash_hmac('sha256', 
        $header . '.' . $payload, 
        $_ENV['KEY'], true);

        // Deve ser retornado como base64url encode, caso contrário gera problema no JWT
        return self::base64url_encode($signature);
    }

    public static function validateToken($jwt){
        
        $tokenPartials = explode('.', $jwt);
        
        // Não possui 3 partes não é JWT válido
        if(count($tokenPartials) !== 3) return false;
        
        // Atribui as partes do token a seus respectivos nomes
        [$header, $payload, $signature] = $tokenPartials;
        
        
        if($signature !== self::signature($header, $payload)) return false;
        
        return self::base64url_decode($payload);
    }

    public static function base64url_encode($data){
        return rtrim(strtr(base64_encode($data), "+/", "-_"), "=");
    }

    public static function base64url_decode($data){
        $padding = strlen($data) % 4;
        
        // Problema na quantidade do $padding - 4
        $padding !== 0 && $data .= str_repeat("=",  (4 - $padding));

        $data = strtr($data, '-_', '+/');

        return json_decode(base64_decode($data), true);
    }
    
}