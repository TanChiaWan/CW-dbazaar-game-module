<?php
//TEST SUCCESSFUL!
include_once "includes/mysql_connection.php";

$d1_prize = $_POST["day1prize"];
$d2_prize = $_POST["day2prize"];
$d3_prize = $_POST["day3prize"];
$d4_prize = $_POST["day4prize"];
$d5_prize = $_POST["day5prize"];
$d6_prize = $_POST["day6prize"];
$d7_prize = $_POST["day7prize"];

$d1_prize_desc = $d1_prize . " GOLD COINS !";
$d2_prize_desc = $d2_prize . " GOLD COINS !";
$d3_prize_desc = $d3_prize . " GOLD COINS !";
$d4_prize_desc = $d4_prize . " GOLD COINS !";
$d5_prize_desc = $d5_prize . " GOLD COINS !";
$d6_prize_desc = $d6_prize . " GOLD COINS !";
$d7_prize_desc = $d7_prize . " GOLD COINS !!!!";

$query1 = "UPDATE login_collection SET prize_desc='$d1_prize_desc',
gold_coin_amount='$d1_prize' WHERE day_id=1";

$query2 = "UPDATE login_collection SET prize_desc='$d2_prize_desc',
gold_coin_amount='$d2_prize' WHERE day_id=2";

$query3 = "UPDATE login_collection SET prize_desc='$d3_prize_desc',
gold_coin_amount='$d3_prize' WHERE day_id=3";

$query4 = "UPDATE login_collection SET prize_desc='$d4_prize_desc',
gold_coin_amount='$d4_prize' WHERE day_id=4";

$query5 = "UPDATE login_collection SET prize_desc='$d5_prize_desc',
gold_coin_amount='$d5_prize' WHERE day_id=5";

$query6 = "UPDATE login_collection SET prize_desc='$d6_prize_desc',
gold_coin_amount='$d6_prize' WHERE day_id=6";

$query7 = "UPDATE login_collection SET prize_desc='$d7_prize_desc',
gold_coin_amount='$d7_prize' WHERE day_id=7";


$connection->query($query1);
$connection->query($query2);
$connection->query($query3);
$connection->query($query4);
$connection->query($query5);
$connection->query($query6);
$connection->query($query7);

$connection->close();
?>

<script>
    window.location.href = "admin-games.php";
</script>