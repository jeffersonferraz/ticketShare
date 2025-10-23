<?php

class Cities extends Database {

    public function getCities($params = []) {

        // check if there is a DB communication error
        $connection = $this->connect();
        if (is_array($connection) && $connection['status'] == 'error') {

            // throw back the error
            return $connection;
        }

        $sql = "
            SELECT * FROM cities
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