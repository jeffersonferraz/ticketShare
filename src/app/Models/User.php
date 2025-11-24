<?php
namespace App\Models;

use PDO;
use App\Core\Database;

class User {
	// implement attributes

  public function getUser($params = []) {
    // check if there is a DB communication error
    $connection = Database::connect();

    if (is_array($connection) && $connection['status'] == 'connection-error') {
      // throw back the error
      return $connection;
    }

    $sql = "
      SELECT * FROM users 
      WHERE email = :email
    ";

    $statement = $connection->prepare($sql);
    $statement->execute($params);
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);

    // throw back the results
    return [
      'status' => 'success',
      'data' => $results
    ];
  }

  public function createUser($params = []) {
    // check if there is a DB communication error
    $connection = Database::connect();

    if (is_array($connection) && $connection['status'] == 'connection-error') {
      // throw back the error
      return $connection;
    }

    $sql = "
      INSERT INTO users (firstname, lastname, email, password) 
      VALUES (:firstname, :lastname, :email, :password)
    ";
    
    $statement = $connection->prepare($sql);
    $statement->execute($params);
    $results = $statement->rowCount();
    
    // throw back the results
    return [
      'status' => 'success',
      'modified' => $results
    ];
  }
}