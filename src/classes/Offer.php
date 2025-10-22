<?php

class Offer extends Database {

    public function query($sql, $params = []) {

        $statement = $this->connect()->prepare($sql);
        $statement->execute($params);

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        // throw back the results
        return [
            'status' => 'success',
            'data' => $results
        ];
    }

    public function getOffers($departure, $arrival) {

        $params = [
            ':departure' => $departure,
            ':arrival' => $arrival
            ];
        
        $sql = "
            SELECT * FROM offers 
            WHERE departure = :departure
            AND arrival = :arrival
            ";
        $statement = $this->connect()->prepare($sql);
        $statement->execute($params);
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        // throw back the results
        return [
            'status' => 'success',
            'data' => $results
        ];
    }

    public function updateOffer($offerId, $departure, $arrival, $datetime) {
        
        $params = [
            ':offerId' => $offerId,
            ':departure' => $departure,
            ':arrival' => $arrival,
            ':datetime' => $datetime
            ];
        
        $sql = "
            UPDATE offers
            SET departure = :departure, arrival = :arrival, datetime = :datetime
            WHERE offerId = :offerId
            ";
        $statement = $this->connect()->prepare($sql);
        $statement->execute($params);
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        // throw back the results
        return [
            'status' => 'success',
            'data' => $results
        ];
    }

    public function deleteOffer($offerId) {
        
        $params = [
            ':offerId' => $offerId,
            ];
        
        $sql = "
            DELETE FROM offers
            WHERE offerId = :offerId
            ";
        $statement = $this->connect()->prepare($sql);
        $statement->execute($params);
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        // throw back the results
        return [
            'status' => 'success',
            'data' => $results
        ];
    }

    public function getOffersByUserId($userId) {

        $params = [
            ':creatorId' => $userId
            ];
        
        $sql = "
            SELECT * FROM offers 
            WHERE creatorId = :creatorId
            ";
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