<?php
//TEST SUCCESSFUL!
include_once "includes/mysql_connection.php";

$common_prize = $_POST["commonprize"];
$rare_prize = $_POST["rareprize"];
$epic_prize = $_POST["epicprize"];
$high_probability_level = $_POST["higherprobabilitylevel"];

$common_prize_desc = $common_prize . " GOLD COINS !";
$rare_prize_desc = $rare_prize . " GOLD COINS !";
$epic_prize_desc = $epic_prize . " GOLD COINS + SPIN AGAIN !!!";

$query1 = "UPDATE spin_to_win SET prize_desc='$common_prize_desc',
gold_coin_amount='$common_prize' WHERE prize_id=1";

$query2 = "UPDATE spin_to_win SET prize_desc='$rare_prize_desc',
gold_coin_amount='$rare_prize' WHERE prize_id=2";

$query3 = "UPDATE spin_to_win SET prize_desc='$epic_prize_desc',
gold_coin_amount='$epic_prize' WHERE prize_id=3";

$query4 = "UPDATE game_settings SET stw_template='$high_probability_level' WHERE mode_id=1";

$connection->query($query1);
$connection->query($query2);
$connection->query($query3);
$connection->query($query4);

$connection->close();
?>

<script>
    window.location.href = "admin-games.php";
</script>