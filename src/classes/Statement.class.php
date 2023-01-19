<?php

class Statement {

    public $values;
    public $table;
    public $keys;
    public $link;


    public function __construct($link, $values, $table, $keys) {

        $this->link = $link;
        $this->values = $values;
        $this->table = $table;
        $this->keys = $keys;

    }

    public function insert() {

        $rows = implode(', ', $this->keys);
        $valueKeys = ":" . implode(', :', $this->keys);
        $sql = "INSERT INTO " . $this->table . " ($rows) VALUES ($valueKeys)";

        $parameters = array_combine($this->keys, $this->values);

        $stmt = $this->link->prepare($sql);

        // $stmt->execute($parameters);

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
