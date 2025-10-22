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

    public function getOffersByUserId($userId) {

        $params = [
            ':creatorId' => $userId
            ];
        
        $sql = "SELECT * FROM offers WHERE creatorId = :creatorId";
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