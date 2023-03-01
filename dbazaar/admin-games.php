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

    <div id="admin_title_block">
        <h1 id="admin_title">Games</h1>
    </div>

    <div id="game_content_block">
        <div class="game_button">
            <button class="game_icon" onclick="window.location.href='admin-edit-stw.php'">
                <img src="assets/button_spin_to_win2.png">
            </button>
            <h6 class="game_name">Spin-To-Win</h6>
        </div>
        

        <div class="game_button">
            <button class="game_icon"  onclick="window.location.href='admin-edit-dlc.php'">
                <img src="assets/button_login_collection2.png">
            </button>
            <h6 class="game_name">Login Collection</h6>
        </div>
        
    </div>

    </section>

</body>
</html>