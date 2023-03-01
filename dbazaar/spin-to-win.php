<?php
    include_once "includes/mysql_connection.php";

    $query = "SELECT prize_desc, gold_coin_amount FROM spin_to_win";
    $result = $connection->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $spin_to_win_data_item["prize_desc"] = $row["prize_desc"];
            $spin_to_win_data_item["gold_coin_amount"] = $row["gold_coin_amount"];

            $spin_to_win_items[] = $spin_to_win_data_item;
        }
    }

    $query2 = "SELECT last_spin_date, gold_coin_amount FROM user WHERE user_name = 'test'";
    $result2 = $connection->query($query2);

    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            $last_spin_date = $row["last_spin_date"];
            $gold_coin_amount = $row["gold_coin_amount"];
        }
    }

    $query3 = "SELECT stw_template FROM game_settings";
    $result3 = $connection->query($query3);

    if ($result3->num_rows > 0) {
        while ($row = $result3->fetch_assoc()) {
            $template = $row["stw_template"];
        }
    }

    $connection->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>DBazaar - Spin To Win</title>
    <link href="styles/games.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/phaser@3.15.1/dist/phaser-arcade-physics.min.js"></script>
    
</head>
<body>
    <header>
        <nav class="client-nav">
            <button class="btn_done done" onclick="saveData()"><b>Done</b></button>
        </nav>
    </header>

    <form action="process-stw.php" method="post">
        <input type="text" name="lsd" id="lsd" style="display: none;"/>
        <input type="number" name="gca" id="gca" style="display: none;"/>
        <input type="submit" name="sb" id="sb" style="display: none;"/>
    </form>

    <script>
        function saveData() {
            document.getElementById("lsd").value = last_spin_date;
            document.getElementById("gca").value = gold_coin_amount_int;
            document.getElementById("sb").click();
        }
    </script>

    <div class="game_scene">
        <script type="text/javascript">
            var common_prize = "<?php echo $spin_to_win_items[0]["prize_desc"];?>";
            var rare_prize = "<?php echo $spin_to_win_items[1]["prize_desc"];?>";
            var epic_prize = "<?php echo $spin_to_win_items[2]["prize_desc"];?>";

            var common_gold_coin_amount = "<?php echo $spin_to_win_items[0]["gold_coin_amount"];?>";
            var rare_gold_coin_amount = "<?php echo $spin_to_win_items[1]["gold_coin_amount"];?>";
            var epic_gold_coin_amount = "<?php echo $spin_to_win_items[2]["gold_coin_amount"];?>";

            var last_spin_date = "<?php echo $last_spin_date;?>";
            var gold_coin_amount = "<?php echo $gold_coin_amount;?>";

            var template = "<?php echo $template;?>";
        </script>
        <script type="text/javascript" src="js/spin_to_win.js"></script>
    </div>
    
</body>
</html>