<?php

include_once "includes/mysql_connection.php";

$last_spin_date = $_POST['lsd'];
$gold_coin_amount = $_POST['gca'];

$query = "UPDATE user SET last_spin_date='$last_spin_date', 
gold_coin_amount='$gold_coin_amount' WHERE user_name='test'";

$connection->query($query);

$connection->close();
?>

<script>
    window.location.href = "index.php";
</script>



