<?php
/**
 * The php file for the profile, shows users information like username, nickname, and game info.
 */

//** Include the header and Connect files. */
include "header.php";
include "server/connect.php";

//** If user accesses this page not logged in redirect to the index. */
if (!isset($_SESSION['userID'])){
    header("Location: index.php");
}


//** Use a select and join command to get the wins losses and games associated with the current userID 
/* This is to make sure that the profile stays updated as the user plays games.
**/
$command = "SELECT `wins`, `losses`, `games`  FROM users
JOIN userstats ON users.userID = userstats.userID WHERE users.userID = ?";
$stmt = $dbh->prepare($command);
$params = [$_SESSION['userID']];
$check = $stmt->execute($params);
if($row = $stmt->fetch()){
    $wins = $row['wins']; //** Set the new values gotten from the database  */
    $losses = $row['losses'];
    $games = $row['games'];
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Rock Paper Scissors: Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/rps.css">
</head>

<body>
    <div id="content">
        <h2></h2>
        <div id="subdiv">
            <?php {
                //** Echo out all the users information into the div to display it. */
                echo "<h2>PROFILE</h2>";
                echo "<p>Username: $_SESSION[userName]</p>";
                echo "<p>Nickname: $_SESSION[userNickName]</p>";
                echo "<p>Wins: $wins</p>";
                echo "<p>Losses: $losses</p>";
                echo "<p>Games: $games</p>";
            }
            ?>
        </div>
    </div>
</body>

</html>