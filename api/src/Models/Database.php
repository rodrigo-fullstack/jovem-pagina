<?php


namespace App\Models;

use App\Config\Config;
use App\Services\UserService;
use PDO;
use PDOException;

class Database{
    private static $db_host = Config::DB_HOST;
    private static $db_user = Config::DB_USER;
    private static $db_pass = Config::DB_PASS;
    private static $db_port = Config::DB_PORT;
    private static $db_name = Config::DB_NAME;


    private $dbh;
    private $stmt;
    private $error;

    public function getConnection(){
        $dsn = "mysql:host=" . self::$db_host . ";dbname=" . self::$db_name . ";port=" . self::$db_port;

        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        $this->dbh = new PDO($dsn, self::$db_user, self::$db_pass, $options);
    }

    public function query($sql){
        // Se estiver definida a conexão...
        if(isset($this->dbh)){
            // Prepara
            return $this->stmt = $this->dbh->prepare($sql);
        }

    }

    public function execute(){
        // Se estiver definido o statement...
        if(isset($this->stmt)){
            // Executa
            $this->stmt->execute();
        }
        
    }

    // Vincula no Statement
    public function bind($param, $value){
        if(isset($this->stmt)){
            $this->stmt->bindValue($param, $value);

        }

    }

    // Recupera 1 resultado...
    public function fetchOne(){
        if(isset($this->stmt)){
            return $this->stmt->fetch();
        }

    }

    // Recupera Todos...
    public function fetchAll(){
        // Se está definido, retorna todos os resultados
        if(isset($this->stmt)){
            return $this->stmt->fetchAll();
        }
        // Se não está retorna nulo
        return null;

    }

    // Retorna verdadeiro se o último id inserido é > 0
    public function verifyLastInsertId(){
        // Se o dbh estiver definido retorna true ou false se houve inserção...
        if(isset($this->dbh)){
            return $this->dbh->lastInsertId() > 0 ? true : false;

        }
        // Retorna nulo se não foi definido...
        return null;
    }

    public function getLastInsertId(){
        // Se o dbh estiver definido retorna true ou false se houve inserção...
        if(isset($this->dbh)){
            return $this->dbh->lastInsertId();

        }
        // Retorna nulo se não foi definido...
        return null;
    }

    public function getAffectedRows(){
        if(isset($this->stmt)){
            return $this->stmt->rowCount();
        }
        return null;
    }
}