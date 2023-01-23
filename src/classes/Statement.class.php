<?php

class Statement {

    public $link;
    public $values;
    public $table;
    public $keys;
    public $parameters;
    public $stmt;

    public function __construct($link, $values, $table, $keys, $sql) {

        $this->link = $link;
        $this->values = $values;
        $this->table = $table;
        $this->keys = $keys;
        $this->parameters = array_combine($keys, $values);
        $this->preparing($sql);

    }


    public function preparing($sql) {

        $this->stmt = $this->link->prepare($sql);

        foreach ($this->parameters as $key => &$value) {
            $this->stmt->bindParam(":" . $key, $value);
        }

    }


    public function executing($param) {

        $this->stmt->execute($param);
        echo "<p>Fertig!</p>";

    }


    public function select($departure_city, $arrival_city) {
        
        $stmt = $this->link->query("SELECT * FROM trip WHERE departure_city = '$departure_city'
                                    AND arrival_city = '$arrival_city'");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;

    }

}