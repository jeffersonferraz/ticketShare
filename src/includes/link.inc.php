<?php
include_once ("../includes/autoloader.inc.php");
include_once ("../includes/config.inc.php");

$connection = new Database(SERVER_1, DATABASE_1, USER_1, PASSWORD_1);
$link = $connection->connectDb();

$connection2 = new Database(SERVER_2, DATABASE_2, USER_2, PASSWORD_2);
$link2 = $connection2->connectDb();
