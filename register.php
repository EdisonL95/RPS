<?php
/**
 * The php file for the registration, takes in form info and registers a user.
 */

 //** Connect to the server */
include "server/connect.php";
//** Include the header */
include 'header.php';
?>


<!DOCTYPE html>
<html>

<head>
    <title>Rock Paper Scissors: Registration</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/rps.css">
</head>

<body>
    <div id="content">
        <h2>Register</h2>
        <!--Form that connects to the registration script, posts all the user information entered-->
        <form action="server/register_script.php" method="post">
            <input type="text" name="username" placeholder="Username"><br>
            <input type="text" name="nickname" placeholder="Nickname"><br>
            <input type="email" name="email" placeholder="Email"><br>
            <input type="password" name="password" placeholder="Password"><br>
            <input type="submit">
        </form>
        <?php
        //** Uses a $_GET checker for errors, if the url matches the corresponding error in the list display an error message.
        //** If successful, display a success message. */
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "empty") {
                echo "<h3>ERROR: One of the fields are empty.</h3>";
            } else if ($_GET["error"] == "shortpass") {
                echo "<h3>ERROR: Password must be 6 characters or more.</h3>";
            } else if ($_GET["error"] == "shortusername") {
                echo "<h3>ERROR: Username must be 6 characters or more..</h3>";
            } else if ($_GET["error"] == "specialchar") {
                echo "<h3>ERROR: Username/Nickname cannot contain special characters.</h3>";
            } else if ($_GET["error"] == "userexists") {
                echo "<h3>ERROR: Username/Email/Nickname already exists.</h3>";
            }
        } else if (isset($_GET["register"])) {
            if ($_GET["register"] == "success") {
                echo "<h3>Registration Successful!</h3>";
            }
        }
        ?>
    </div>
</body>

</html>