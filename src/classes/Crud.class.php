<?php 
include_once ("../includes/autoloader.inc.php");
include_once ("../includes/link.inc.php");

class Crud {

    public function create($table, $keys) {

        $rows = implode(', ', $keys);
        $valueKeys = ":" . implode(', :', $keys);
        $sql = "INSERT INTO $table ($rows) VALUES ($valueKeys)";
        return($sql);
        
    }

    public function read($table, $keys) {

        // andere Weise überlegen
        $k1 = ":".$keys[0];
        $k2 = ":".$keys[1];

        $sql = "SELECT * FROM $table WHERE $keys[0] = $k1
                AND $keys[1] = $k2";
        return($sql);

    }

    public function update() {
       
    }

    public function delete() {

    }

}