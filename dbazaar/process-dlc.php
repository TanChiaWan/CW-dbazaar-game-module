<?php

include_once "includes/mysql_connection.php";

$last_collect_date = $_POST['lcd'];
$accumulated_collect_day = $_POST['acd'];
$gold_coin_amount = $_POST['gca'];

$query = "UPDATE user SET last_collect_date='$last_collect_date', 
accumulated_collect_day='$accumulated_collect_day',
gold_coin_amount='$gold_coin_amount' WHERE user_name='test'";

$connection->query($query);

$connection->close();
?>

<script>
    window.location.href = "index.php";
</script>



