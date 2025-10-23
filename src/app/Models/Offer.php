<?php

class Offer extends Database {

    // create offer
    public function createOffer($params = []) {

        // check if there is a DB communication error
        $connection = $this->connect();
        if (is_array($connection) && $connection['status'] == 'error') {

            // throw back the error
            return $connection;
        }

        $sql = "
            INSERT INTO offers (creatorId, departure, arrival, datetime) 
            VALUES (:creatorId, :departure, :arrival, :datetime)
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

    // read offers
    public function getOffers($params) {

        // check if there is a DB communication error
        $connection = $this->connect();
        if (is_array($connection) && $connection['status'] == 'error') {

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
        $connection = $this->connect();
        if (is_array($connection) && $connection['status'] == 'error') {

            // throw back the error
            return $connection;
        }
        
        $sql = "
            UPDATE offers
            SET departure = :departure, arrival = :arrival, datetime = :datetime
            WHERE offerId = :offerId
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

    // delete offer
    public function deleteOffer($params) {

        // check if there is a DB communication error
        $connection = $this->connect();
        if (is_array($connection) && $connection['status'] == 'error') {

            // throw back the error
            return $connection;
        }
        
        $sql = "
            DELETE FROM offers
            WHERE offerId = :offerId
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

    // read all offers from one user
    public function getOffersByUserId($userId) {

        // check if there is a DB communication error
        $connection = $this->connect();
        if (is_array($connection) && $connection['status'] == 'error') {

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