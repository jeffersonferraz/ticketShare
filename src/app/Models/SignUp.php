<?php

use App\Core\Database;

class Signup {

    public function checkUser($params = []) {

        // check if there is a DB communication error
        $connection = Database::connect();
        if (is_array($connection) && $connection['status'] == 'error') {

            // throw back the error
            return $connection;
        }

        $sql = "
            SELECT * FROM users 
            WHERE email = :email
            ";
        
        $statement = $connection->prepare($sql);
        $statement->execute($params);
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        // throw back the results
        return [
            'status' => 'success',
            'data' => $results
        ];
    }

    public function createUser($params = []) {

        // check if there is a DB communication error
        $connection = Database::connect();
        if (is_array($connection) && $connection['status'] == 'error') {

            // throw back the error
            return $connection;
        }

        $sql = "
            INSERT INTO users (firstname, lastname, email, password) 
            VALUES (:firstname, :lastname, :email, :password)
            ";
        
        $statement = $connection->prepare($sql);
        $statement->execute($params);
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        // throw back the results
        return [
            'status' => 'success',
            'data' => $results
        ];
    }

}