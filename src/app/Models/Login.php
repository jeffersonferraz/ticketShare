<?php

class Login extends Database {

    public function getUser($params = []) {
        
        // check if there is a DB communication error
        $connection = $this->connect();
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
}