<?php
    include_once "includes/mysql_connection.php";

    $data_items = [];
    $index = 0;

    $query1 = "SELECT gold_coin_amount FROM login_collection";
    $result1 = $connection->query($query1);

    if ($result1->num_rows > 0) {
        while ($row = $result1->fetch_assoc()) {
            $data_items[$index] = $row["gold_coin_amount"];
            $index += 1;
        }
    }
?>


<!DOCTYPE html>
<html>
<head>
    <title>DBazaar - Admin</title>
    <link href="styles/main.css" rel="stylesheet">
</head>

<body>
    <header>
        <nav class="admin-nav">
            <p class="navbar-text">(Admin NavBar Content)</p>
            <!-- official dbazaar website navigation bar settings -->
        </nav>
    </header>

    <aside>
        <ul>
            <li><a href="admin-games.php">Games</a></li>
            <li><a href="admin-reports.php">Reports</a></li>
        </ul>
    </aside>

    <section class="contents">

    <h1 class="admin_game_title"> Login Collection </h1>

    <form name="edit_dlc_form" method="POST" onsubmit="checkUpdateInputs()" action="process-admin-edit-dlc.php">

    <table class="edit_game_table">
        <tr>
            <td>
                <label for="prized1">Day 1 Prize: </label>
                <input class="input_prize_dlc" type="number" name="day1prize" id="day1prize" value="<?php echo $data_items[0];?>"/>
                <img src="assets/icon_gold_coin2.png" style="width: 10%; vertical-align: middle;"/>
            </td>
        </tr>
        <tr>
            <td>
                <label for="prized2">Day 2 Prize: </label>
                <input class="input_prize_dlc" type="number" name="day2prize" id="day2prize" value="<?php echo $data_items[1];?>"/>
                <img src="assets/icon_gold_coin2.png" style="width: 10%; vertical-align: middle;"/>
            </td>
        </tr>
        <tr>
            <td>
                <label for="prized3">Day 3 Prize: </label>
                <input class="input_prize_dlc" type="number" name="day3prize" id="day3prize" value="<?php echo $data_items[2];?>"/>
                <img src="assets/icon_gold_coin2.png" style="width: 10%; vertical-align: middle;"/>
            </td>
        </tr>
        <tr>
            <td>
                <label for="prized4">Day 4 Prize: </label>
                <input class="input_prize_dlc" type="number" name="day4prize" id="day4prize" value="<?php echo $data_items[3];?>"/>
                <img src="assets/icon_gold_coin2.png" style="width: 10%; vertical-align: middle;"/>
            </td>
        </tr>
        <tr>
            <td>
                <label for="prized5">Day 5 Prize: </label>
                <input class="input_prize_dlc" type="number" name="day5prize" id="day5prize" value="<?php echo $data_items[4];?>"/>
                <img src="assets/icon_gold_coin2.png" style="width: 10%; vertical-align: middle;"/>
            </td>
        </tr>
        <tr>
            <td>
                <label for="prized6">Day 6 Prize: </label>
                <input class="input_prize_dlc" type="number" name="day6prize" id="day6prize" value="<?php echo $data_items[5];?>"/>
                <img src="assets/icon_gold_coin2.png" style="width: 10%; vertical-align: middle;"/>
            </td>
        </tr>
        <tr>
            <td>
                <label for="prized7">Day 7 Prize: </label>
                <input class="input_prize_dlc" type="number" name="day7prize" id="day7prize" value="<?php echo $data_items[6];?>"/>
                <img src="assets/icon_gold_coin2.png" style="width: 10%; vertical-align: middle;"/>
            </td>
        </tr>
        
    </table>

    <p id="admin_edit_game_buttons">
		<input type="submit" value="Update">
		<input type="reset" value="Reset">
	</p>

    </form>

    <script type="text/javascript">
        var pattern_numeric = /^[0-9]+$/;

        function validatePrizes(prizes) {
            var valid_alert = "";
            var valid = true;

            for (let i = 0; i < prizes.length; i++) {
                if (prizes[i] == "" || !pattern_numeric.test(prizes[i])) {
                    valid = false;
                }
            }

            if (valid == false) {
                valid_alert += "\nAll prizes input fields must be filled and in numeric form";
            }

            return [valid_alert, valid]
        }

        function checkUpdateInputs() {
            var valid_alert = "";
            
            var prize_d1 = document.forms["edit_dlc_form"]["day1prize"].value;
            var prize_d2 = document.forms["edit_dlc_form"]["day2prize"].value;
            var prize_d3 = document.forms["edit_dlc_form"]["day3prize"].value;
            var prize_d4 = document.forms["edit_dlc_form"]["day4prize"].value;
            var prize_d5 = document.forms["edit_dlc_form"]["day5prize"].value;
            var prize_d6 = document.forms["edit_dlc_form"]["day6prize"].value;
            var prize_d7 = document.forms["edit_dlc_form"]["day7prize"].value;

            var array_prizes = [
                prize_d1,
                prize_d2,
                prize_d3,
                prize_d4,
                prize_d5,
                prize_d6,
                prize_d7
            ];

            var result = validatePrizes(array_prizes);

            valid_alert += result[0];

            if (result[1] == false) {
                alert(valid_alert);
            }

        }
        
    </script>

    </section>

</body>
</html>