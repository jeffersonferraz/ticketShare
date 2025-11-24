<?php
namespace App\Core;

use PDO;
use PDOException;

require_once __DIR__ . '../../../config/config.php';

class Database {
    
    public static function connect(){
        
        try {
            $username = DB_USER;    // MySQL username
            $password = DB_PASS;    // MySQL password
            $database = DB_NAME;    // Database name
            $host = DB_HOST;        // MySQL container name

            $dsn = "mysql:dbname=". $database .";host=". $host;

            $connection = new PDO($dsn ,$username, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $connection;

        } catch (PDOException $error) {

            // throw back the error
            return [
                'status' => 'connection-error',
                'message' => $error->getMessage()
            ];
        }
    }
}