<?php

//create mysql connection by using MySQLi object-oriented way

$db_server="localhost";
$db_username="root";
$db_password="";
$db_name="dbazaar";

$connection = new mysqli($db_server, $db_username, $db_password);

if ($connection->connect_error) {
    die("MySQL connection failed: " . $connection->connect_error . "<br>");
}

echo "MySQL connected sucessfully" . "<br>";

//create database

$db = "CREATE DATABASE dbazaar";

if ($connection->query($db) === TRUE) {
    echo "Database created succesfully" . "<br>";
}
else {
    echo "Error creating database: " . $connection->error . "<br>";
}

//close mysql connection
$connection->close();
?>



<?php

//reconnect mysql again with new created database
$connection = new mysqli($db_server, $db_username, $db_password, $db_name);

if ($connection->connect_error) {
    die("MySQL connection failed: " . $connection->connect_error . "<br>");
}

echo "MySQL connected sucessfully" . "<br>";



//create tables

$table_game_one = "CREATE TABLE spin_to_win (
    prize_id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    prize_level VARCHAR(10) NOT NULL,
    prize_desc VARCHAR(50) NOT NULL,
    gold_coin_amount INT(10) NOT NULL
)";

if ($connection->query($table_game_one) === TRUE) {
    echo "Table 'spin_to_win' created successfully" . "<br>";
}
else {
    echo "Error creating table 'spin_to_win': " . $connection->error . "<br>";
}



$table_game_two = "CREATE TABLE login_collection (
    day_id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    accumulate_days INT(2) NOT NULL,
    prize_desc VARCHAR(50) NOT NULL,
    gold_coin_amount INT(10) NOT NULL
)";

if ($connection->query($table_game_two) === TRUE) {
    echo "Table 'login_collection' created successfully" . "<br>";
}
else {
    echo "Error creating table 'login_collection': " . $connection->error . "<br>";
}



$table_user = "CREATE TABLE user (
    user_id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(50) NOT NULL,
    last_spin_date VARCHAR(100) NOT NULL,
    last_collect_date VARCHAR(100) NOT NULL,
    accumulated_collect_day INT(2) NOT NULL,
    gold_coin_amount INT(8) NOT NULL
)";

if ($connection->query($table_user) === TRUE) {
    echo "Table 'user' created successfully" . "<br>";
}
else {
    echo "Error creating table 'user': " . $connection->error . "<br>";
}



$table_game_settings = "CREATE TABLE game_settings (
    mode_id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    stw_template VARCHAR(10) NOT NULL
)";

if ($connection->query($table_game_settings) === TRUE) {
    echo "Table 'game_settings' created successfully" . "<br>";
}
else {
    echo "Error creating table 'game_settings': " . $connection->error . "<br>";
}



// Populate data

$data_population = "INSERT INTO spin_to_win 
(prize_level, prize_desc, gold_coin_amount) 
VALUES ('COMMON', '10 GOLD COINS !', 10);";

$data_population .= "INSERT INTO spin_to_win 
(prize_level, prize_desc, gold_coin_amount) 
VALUES ('RARE', '50 GOLD COINS !', 50);";

$data_population .= "INSERT INTO spin_to_win 
(prize_level, prize_desc, gold_coin_amount) 
VALUES ('EPIC', '100 GOLD COINS + SPIN AGAIN !!!', 100);";



$data_population .= "INSERT INTO login_collection 
(accumulate_days, prize_desc, gold_coin_amount) 
VALUES (1, '1 GOLD COIN !', 1);";

$data_population .= "INSERT INTO login_collection 
(accumulate_days, prize_desc, gold_coin_amount) 
VALUES (2, '10 GOLD COINS !', 10);";

$data_population .= "INSERT INTO login_collection 
(accumulate_days, prize_desc, gold_coin_amount) 
VALUES (3, '20 GOLD COINS !', 20);";

$data_population .= "INSERT INTO login_collection 
(accumulate_days, prize_desc, gold_coin_amount) 
VALUES (4, '50 GOLD COINS !', 50);";

$data_population .= "INSERT INTO login_collection 
(accumulate_days, prize_desc, gold_coin_amount) 
VALUES (5, '100 GOLD COINS !', 100);";

$data_population .= "INSERT INTO login_collection 
(accumulate_days, prize_desc, gold_coin_amount) 
VALUES (6, '200 GOLD COINS !', 200);";

$data_population .= "INSERT INTO login_collection 
(accumulate_days, prize_desc, gold_coin_amount) 
VALUES (7, '500 GOLD COINS !!!!', 500);";



$data_population .= "INSERT INTO user 
(user_name, last_spin_date, last_collect_date, accumulated_collect_day, gold_coin_amount)
VALUES ('test', '-', '-', 0, 50);";



$data_population .= "INSERT INTO game_settings
(stw_template) 
VALUES ('common');";



if ($connection->multi_query($data_population) === TRUE) {
    echo "Data successfully populated to 'spin_to_win', 'login_collection', 'user', and 'game_settings' tables" . "<br>";
}
else {
    echo "Error: " . $data_population . "<br>" . $connection->error . "<br>";
}


//close MySQL connection

$connection->close();

?>