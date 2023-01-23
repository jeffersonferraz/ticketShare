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

    public function read() {

    }

    public function update() {

    }

    public function delete() {

    }

}