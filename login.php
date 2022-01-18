<?php
/**
 * The php file for the login, checks for login errors and logs the user in.
 */

 //** Connect to the server. */
include "server/connect.php";
//** Include the header */
include 'header.php';
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
    <div id="content">
        <h2>Login</h2>
        <!-- Form that posts to the login script. -->
        <form action="server/login_script.php" method="post">
            <input type="text" name="username" placeholder="Username"><br>
            <input type="password" name="password" placeholder="Password"><br>
            <input type="submit">
        </form>
        <?php
        //** Uses a $_GET to check the link for certain errors, if they match the specified error display a message. */
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "wronguser") {
                echo "<h3>ERROR: Username is incorrect.</h3>";
            } else if ($_GET["error"] == "wrongpass") {
                echo "<h3>ERROR: Password is incorrect.</h3>";
            } else if ($_GET["error"] == "empty") {
                echo "<h3>ERROR: Fields are empty.</h3>";
            }
        }
        ?>
    </div>
</body>

</html>