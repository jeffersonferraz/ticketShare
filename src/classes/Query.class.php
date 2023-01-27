<?php 
include_once ("../includes/autoloader.inc.php");
include_once ("../includes/link.inc.php");

class Query {

    public function create($table, $keys) {

        $rows = implode(', ', $keys);
        $placeholder = ":" . implode(', :', $keys);

        $sql = "INSERT INTO $table ($rows) VALUES ($placeholder)";
        
        return($sql);
        
    }

    public function read($table, $keys) {

        
        $placeholder = ":" . implode(" :", $keys);
        $placeholder = explode(" ", $placeholder);

        for ($index = 0; $index < count($keys); $index++) {
            $text[$index] = $keys[$index] . " = " . $placeholder[$index];
        }
        $result = join(" AND ", $text);

        $sql = "SELECT departure_city, departure, arrival_city, arrival, seats, price
                FROM $table WHERE $result";

        return($sql);

    }

    public function update() {
       
    }

    public function delete() {

    }

}