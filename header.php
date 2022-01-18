<?php
/**
 * The php file for the header of the website. Since every page will have the same header, this is included for convenience.
 */

 //** Start a session on every page loaded with the header to gain access to session info. */
session_start();
?>


<!DOCTYPE html>
<html>

<head>
    <title>Rock Paper Scissors</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/rps.css">
</head>

<body>
    <div id="heading">
        <h1>Rock Paper Scissors!</h1>
        <div id="headOptions">
            <ul>
                <li><a class="nav" href="index.php">Home</a></li>
                <li><a class="nav" href="rankings.php">Rankings</a></li>
                <?php
                //** If there a session started with a username, meaning that they are logged in echo the html for logged in users. */
                if (isset($_SESSION["userName"])) {
                    echo "<li><a class='nav' href='profile.php'>Profile</a></li>";
                    echo "<li><a class='nav' href='game.php'>Game</a></li>";
                    echo "<li><a class='nav' href='server/logout_script.php'>Logout\n</a></li>";
                } else {
                    //** If no user is logged in display the login and register pages instead. */
                    echo "<li><a class='nav' href='login.php'>Login\n</a></li>";
                    echo "<li><a class='nav' href='register.php'>Register</a></li>";
                }
                ?>
            </ul>
        </div>
    </div>
</body>

</html>