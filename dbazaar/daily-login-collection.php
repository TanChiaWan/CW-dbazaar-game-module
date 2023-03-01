<?php
    include_once "includes/mysql_connection.php";

    $query1 = "SELECT prize_desc, gold_coin_amount FROM login_collection";
    $result1 = $connection->query($query1);

    if ($result1->num_rows > 0) {
        while ($row = $result1->fetch_assoc()) {
            $login_collection_data_item["prize_desc"] = $row["prize_desc"];
            $login_collection_data_item["gold_coin_amount"] = $row["gold_coin_amount"];

            $login_collection_items[] = $login_collection_data_item;
        }
    }

    $query2 = "SELECT last_collect_date, accumulated_collect_day, gold_coin_amount FROM user WHERE user_name = 'test'";
    $result2 = $connection->query($query2);

    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            $last_collect_date = $row["last_collect_date"];
            $accumulated_collect_day = $row["accumulated_collect_day"];
            $gold_coin_amount = $row["gold_coin_amount"];
        }
    }

    $connection->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>DBazaar - Login Collection</title>
    <link href="styles/games.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/phaser@3.15.1/dist/phaser-arcade-physics.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<body>
    <header>
        <nav class="client-nav">
            <button class="btn_done done" onclick="saveData()"><b>Done</b></button>
        </nav>
    </header>

    <form action="process-dlc.php" method="post">
        <input type="text" name="lcd" id="lcd" style="display: none;"/>
        <input type="number" name="acd" id="acd" style="display: none;"/>
        <input type="number" name="gca" id="gca" style="display: none;"/>
        <input type="submit" name="sb" id="sb" style="display: none;"/>
    </form>

    <script>
        function saveData() {
            document.getElementById("lcd").value = last_collect_date;
            document.getElementById("acd").value = accumulated_collect_day_int;
            document.getElementById("gca").value = gold_coin_amount_int;
            document.getElementById("sb").click();
        }
    </script>

    <div class="game_scene">
        <script type="text/javascript">
            var d1_prize = "<?php echo $login_collection_items[0]["prize_desc"];?>";
            var d2_prize = "<?php echo $login_collection_items[1]["prize_desc"];?>";
            var d3_prize = "<?php echo $login_collection_items[2]["prize_desc"];?>";
            var d4_prize = "<?php echo $login_collection_items[3]["prize_desc"];?>";
            var d5_prize = "<?php echo $login_collection_items[4]["prize_desc"];?>";
            var d6_prize = "<?php echo $login_collection_items[5]["prize_desc"];?>";
            var d7_prize = "<?php echo $login_collection_items[6]["prize_desc"];?>";

            var d1_gold_coin_amount = "<?php echo $login_collection_items[0]["gold_coin_amount"];?>";
            var d2_gold_coin_amount = "<?php echo $login_collection_items[1]["gold_coin_amount"];?>";
            var d3_gold_coin_amount = "<?php echo $login_collection_items[2]["gold_coin_amount"];?>";
            var d4_gold_coin_amount = "<?php echo $login_collection_items[3]["gold_coin_amount"];?>";
            var d5_gold_coin_amount = "<?php echo $login_collection_items[4]["gold_coin_amount"];?>";
            var d6_gold_coin_amount = "<?php echo $login_collection_items[5]["gold_coin_amount"];?>";
            var d7_gold_coin_amount = "<?php echo $login_collection_items[6]["gold_coin_amount"];?>";

            let last_collect_date = "<?php echo $last_collect_date;?>";
            var accumulated_collect_day = "<?php echo $accumulated_collect_day;?>";
            var gold_coin_amount = "<?php echo $gold_coin_amount;?>";
        </script>

        <script type="text/javascript" src="js/daily_login_collection.js"></script>

    
        
        
        
    </div>

    

    
</body>
</html>