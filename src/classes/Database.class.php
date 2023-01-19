<?php
include_once ("../includes/config.inc.php");

class Database {

    private $server;
    private $database;
    private $user;
    private $password;

    private $connection;

    //database constructor
    public function __construct($server, $database, $user, $password) {
        $this->server = $server;
        $this->database = $database;
        $this->user = $user;
        $this->password = $password;
        $this->connectDb();
    }

    public function connectDb() {

        try {
            $dsn = "mysql:host=". $this->server .";dbname=". $this->database;
            $this->connection = new PDO($dsn, $this->user, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $this->connection;
        
        }   catch(PDOException $e) {
        
            echo "Die Datenbankverbindung ist fehlerhaft: " . $e->getMessage();

        }

    }

    public function statement() {
        //return insert statement
    }

    public function search() {
        //return search statement
    }

}