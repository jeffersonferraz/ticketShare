<?php

class Statement {

    public $link;
    public $values;
    public $table;
    public $keys;
    public $sql;
    public $parameters;
    public $stmt;

    public function __construct($link, $values, $table, $keys, $sql) {

        $this->link = $link;
        $this->values = $values;
        $this->table = $table;
        $this->keys = $keys;
        $this->sql = $sql;
        $this->parameters = array_combine($keys, $values);
        $this->preparing($this->sql);

    }


    public function preparing() {

        $this->stmt = $this->link->prepare($this->sql);

        foreach ($this->parameters as $key => &$value) {
            $this->stmt->bindParam(":" . $key, $value);
        }

    }


    public function insert() {

        $this->stmt->execute($this->parameters);
        echo "<p>Benutzer wurde registriert!</p>";
        
    }


    public function select() {
        
        $this->stmt->execute($this->parameters);
        $data = $this->stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;

    }

}