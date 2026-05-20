<?php
class Database {
    private $pdo;

    public function __construct ($host, $dbname, $user, $pass){
        try{
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
            $this->pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e){
            die("Erro ao conectar no banco de dados.");
        }
    }

    public function prepare($sql) {
        return $this->pdo->prepare($sql);
    }

}

