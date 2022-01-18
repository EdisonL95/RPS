<?php
/**
 * The php file for the home page, greets the user, or tells them they need to register..
 */

 //** Include the header. */
include "header.php";
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
        <h2></h2>
        <div id="subdiv">
            <?php {
                //** If a login session is started, greet the user and tell them to play, otherwise tell them to register. */
                if (isset($_SESSION["userName"])) {
                    echo "<h2>Hello, $_SESSION[userName]</h2>";
                    echo "<br>";
                    echo "<p>Press the game tab on the header to play Rock Paper Scissors!</p>";
                } else {
                    echo "<p>Please register to gain access to the game.</p>";
                }
            }
            ?>
        </div>
    </div>
</body>

</html>