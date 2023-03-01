<?php
    include_once "includes/mysql_connection.php";

    $data_items = [];
    $index = 0;

    $query1 = "SELECT gold_coin_amount FROM spin_to_win";
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

    <h1 class="admin_game_title"> Spin-To-Win </h1>

    <form name="edit_stw_form" method="POST"  onsubmit="checkUpdateInputs()" action="process-admin-edit-stw.php">

    <table class="edit_game_table">
        <tr>
            <td>
                <label>Common level Prize: </label>
                <input class="input_prize_dlc" type="number" name="commonprize" id="commonprize" value="<?php echo $data_items[0];?>"/>
                <img src="assets/icon_gold_coin2.png" style="width: 10%; vertical-align: middle;"/>
            </td>
        </tr>
        <tr>
            <td>
                <label>Rare level Prize: </label>
                <input class="input_prize_dlc" type="number" name="rareprize" id="rareprize" value="<?php echo $data_items[1];?>"/>
                <img src="assets/icon_gold_coin2.png" style="width: 10%; vertical-align: middle;"/>
            </td>
        </tr>
        <tr>
            <td>
                <label>Epic level Prize: </label>
                <input class="input_prize_dlc" type="number" name="epicprize" id="epicprize" value="<?php echo $data_items[2];?>"/>
                <img src="assets/icon_gold_coin2.png" style="width: 10%; vertical-align: middle;"/>
            </td>
        </tr>
        <tr>
            <td>
                <label>Higher probability to get: </label>
                <select class="input_prize_dlc" name="higherprobabilitylevel" id="higherprobabilitylevel" size="1">
                    <option value="common" selected="selected">COMMON level prize</option>
                    <option value="rare">RARE level prize</option>
                    <option value="epic">EPIC level prize</option>
                </select>
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

        function validateLevel(level) {
            var valid_alert = "";
            var valid = true;

            if (level == "") {
                valid = false;
            }

            if (valid == false) {
                valid_alert += "High probability level must be selected";
            }

            return [valid_alert, valid]
        }

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
            
            var prize_common = document.forms["edit_stw_form"]["commonprize"].value;
            var prize_rare = document.forms["edit_stw_form"]["rareprize"].value;
            var prize_epic = document.forms["edit_stw_form"]["epicprize"].value;
            var high_probability_level = document.forms["edit_stw_form"]["higherprobabilitylevel"].value;
            
            var array_prizes = [
                prize_common,
                prize_rare,
                prize_epic
            ];

            var result_prizes = validatePrizes(array_prizes);
            var result_level = validateLevel(high_probability_level);

            valid_alert += result_prizes[0];
            valid_alert += result_level[0];

            if (result_prizes == false || result_level == false) {
                alert(valid_alert);
            }

        }
        
    </script>

    </section>

</body>
</html>