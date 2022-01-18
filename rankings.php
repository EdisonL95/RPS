<?php
/**
 * The php file for the rankings, shows all users scores, sorted by descending wins.
 */

 //** Include header */
include "header.php";
//** Connect to the database */
include "server/connect.php";

//** This command joins the two tables users and userstats on the key userID and select the nickname and game info from them
/* then it orders by wins descending.
*/
$command = "SELECT `userNickName`, `wins`, `losses`, `games`  FROM users
JOIN userstats ON users.userID = userstats.userID ORDER BY `wins` DESC";
$stmt = $dbh->prepare($command);
$params = [];
$check = $stmt->execute($params);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rock Paper Scissors: Registration</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/rps.css">
</head>

<div id="content">
    <h2></h2>
    <div id="subdiv">
        <h2>RANKINGS</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Wins</th>
                <th>Losses</th>
                <th>Games</th>
            </tr>
            <?php
            //* Display all the rows in the database retrieved. */
                while ($row = $stmt->fetch()) {
                    echo "<tr>";
                    echo "<th>$row[userNickName]</th>";
                    echo "<th>$row[wins]</th>";
                    echo "<th>$row[losses]</th>";
                    echo "<th>$row[games]</th>";
                    echo "</tr>";
                }
            ?>
        </table>
    </div>
</div>
</html>