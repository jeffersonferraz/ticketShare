<?php

class Statement {

    public $values;
    public $table;
    public $keys;
    public $link;


    public function __construct($databaseLink) {
        $this->link = $databaseLink;
    }

    public function insert($values, $table, $keys) {

        $rows = implode(', ', $keys);
        $valueKeys = ":" . implode(', :', $keys);
        $sql = "INSERT INTO $table ($rows) VALUES ($valueKeys)";

        $parameters = array_combine($keys, $values);

        $stmt = $this->link->prepare($sql);

        $stmt->execute($parameters);

        echo "<p>Fertig!</p>";

    }

    // public function select($departure_city, $arrival_city) {
        
    //     $stmt = $this->link->query("SELECT * FROM trip WHERE departure_city = '$departure_city'
    //                                 AND arrival_city = '$arrival_city'");
    //     $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //     return $data;

    // }

    public function update() {
        

    }

    public function delete() {
       

    }

}
