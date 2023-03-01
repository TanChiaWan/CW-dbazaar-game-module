<?php
//create mysql connection by using MySQLi object-oriented way

$db_server="localhost";
$db_username="root";
$db_password="";
$db_name="dbazaar";

$connection = new mysqli($db_server, $db_username, $db_password, $db_name);

if ($connection->connect_error) {
    die("MySQL connection failed: " . $connection->connect_error . "<br>");
}

?>