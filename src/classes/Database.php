<?php
class Database {
    
    public function query($sql, $params = []) {
        try {
            // connection with the database
            $connection = new PDO(
                'mysql:host=' . DB_HOST . ';' . 
                'dbname=' . DB_NAME, DB_USER, DB_PASS
            );
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $statement = $connection->prepare($sql);
            $statement->execute($params);

            $results = $statement->fetchAll(PDO::FETCH_CLASS);

            // throw back the results
            return [
                'status' => 'success',
                'data' => $results
            ];

        } catch (PDOException $error) {
            // throw back the error
            return [
                'status' => 'error',
                'data' => $error->getMessage()
            ];
        }
    }
}