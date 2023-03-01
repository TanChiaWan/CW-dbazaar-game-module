<?php
    include_once "includes/mysql_connection.php";

    $query = "SELECT gold_coin_amount FROM user WHERE user_name = 'test'";
    $result = $connection->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $gold_coin_amount = $row["gold_coin_amount"];
        }
    }
    else {
        $gold_coin_amount = "Error";
    }

    $connection->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>DBazaar - Games</title>
    <link href="styles/main.css" rel="stylesheet">
</head>

<body>
    <header>
        <nav class="client-nav">
            <p class="navbar-text">(Client NavBar Content)</p>
            <!-- official dbazaar website navigation bar settings -->
        </nav>
    </header>

    <div id="game_title_block">
        <h1 id="game_title">Games</h1>
        <p id="gold_coin_text"><?php echo $gold_coin_amount; ?></p>
        <img id="icon_gold_coin" src="assets/icon_gold_coin2.png">
    </div>

    <div id="game_content_block">
        <div class="game_button">
            <button class="game_icon" onclick="window.location.href='spin-to-win.php'">
                <img src="assets/button_spin_to_win2.png">
            </button>
            <h6 class="game_name">Spin-To-Win</h6>
        </div>
        

        <div class="game_button">
            <button class="game_icon"  onclick="window.location.href='daily-login-collection.php'">
                <img src="assets/button_login_collection2.png">
            </button>
            <h6 class="game_name">Login Collection</h6>
        </div>
        
    </div>


</body>
</html>