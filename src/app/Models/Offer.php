<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class Offer {

    public function createOffer($params = []) {

        // check if there is a DB communication error
        $connection = Database::connect();
        if (is_array($connection) && $connection['status'] == 'connection-error') {

            // throw back the error
            return $connection;
        }

        $sql = "
            INSERT INTO offers (creatorId, departure, arrival, datetime) 
            VALUES (:creatorId, :departure, :arrival, :datetime)
            ";

        $statement = $connection->prepare($sql);
        $statement->execute($params);
        $results = $statement->rowCount();

        // throw back the results
        return [
            'status' => 'success',
            'modified' => $results
        ];
    }

    // read offers
    public function getOffers($params) {

        // check if there is a DB communication error
        $connection = Database::connect();
        if (is_array($connection) && $connection['status'] == 'connection-error') {

            // throw back the error
            return $connection;
        }
        
        $sql = "
            SELECT * FROM offers 
            WHERE departure = :departure
            AND arrival = :arrival
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

    // update offer
    public function updateOffer($params) {

        // check if there is a DB communication error
        $connection = Database::connect();
        if (is_array($connection) && $connection['status'] == 'connection-error') {

            // throw back the error
            return $connection;
        }

        $filteredParams = array_filter($params);
        $paramKeys = [];

        foreach ($params as $bindKey => $value) {
            if ($bindKey !== ':offerId' && $value !== NULL) {
                $column = ltrim($bindKey, ':');
                $paramKeys[] = "{$column} = {$bindKey}" ;
            }
        }
        $columns = implode(', ', $paramKeys);
        
        $sql = "
            UPDATE offers
            SET {$columns}
            WHERE offerId = :offerId
            ";

        $statement = $connection->prepare($sql);
        $statement->execute($filteredParams);
        $results = $statement->rowCount();

        // throw back the results
        return [
            'status' => 'success',
            'modified' => $results
        ];
    }

    // delete offer
    public function deleteOffer($params) {

        // check if there is a DB communication error
        $connection = Database::connect();
        if (is_array($connection) && $connection['status'] == 'connection-error') {

            // throw back the error
            return $connection;
        }
        
        $sql = "
            DELETE FROM offers
            WHERE offerId = :offerId
            ";

        $statement = $connection->prepare($sql);
        $statement->execute($params);
        $results = $statement->rowCount();

        // throw back the results
        return [
            'status' => 'success',
            'modified' => $results
        ];
    }

    // read all offers from one user
    public static function getOffersByUserId($userId) {

        // check if there is a DB communication error
        $connection = Database::connect();
        if (is_array($connection) && $connection['status'] == 'connection-error') {

            // throw back the error
            return $connection;
        }

        $params = [
            ':creatorId' => $userId
            ];
        
        $sql = "
            SELECT * FROM offers 
            WHERE creatorId = :creatorId
            ORDER BY created_at DESC
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