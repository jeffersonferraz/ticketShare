<?php
class Database {
    
    protected function connect(){
        
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
                'status' => 'error',
                'data' => $error->getMessage()
            ];
        }
    }

    public function getCities($params = []) {

        $sql = "SELECT * FROM cities";
        $statement = $this->connect()->prepare($sql);
        $statement->execute($params);
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        // throw back the results
        return [
            'status' => 'success',
            'data' => $results
        ];
    }
}