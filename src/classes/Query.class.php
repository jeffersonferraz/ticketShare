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

    public function read($table, $keys, $searchedValues) {

        for ($index = 0; $index < count($keys); $index++) {
            $column[$index] = $keys[$index] . " = :" . $keys[$index];
        }
        $columns = implode(" AND ", $column);

        $sql = "SELECT $searchedValues FROM $table WHERE $columns";

        return($sql);

    }

    public function update() {
       
    }

    public function delete() {

    }

}
?>