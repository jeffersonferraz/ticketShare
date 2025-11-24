<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Cities {

    public static function getCities($params = []) {

        // check if there is a DB communication error
        $connection = Database::connect();
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