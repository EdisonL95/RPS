<?php

/**
 * The php script used to update the userstats table when a game is played.
 */

//** Include header, and connect to the server */
include "connect.php";
include "../header.php";

//** Get parameters for win loss and boolean values. */
$win = filter_input(INPUT_GET, "winparam", FILTER_VALIDATE_BOOL);
$loss = filter_input(INPUT_GET, "lossparam", FILTER_VALIDATE_BOOL);

//** Command updates the game and increases it by one. */
$command = "UPDATE `userstats` SET `games` = `games` + 1 WHERE `userID` = ?";
$stmt = $dbh->prepare($command);
$params = [$_SESSION["userID"]];
$check = $stmt->execute($params);

//** If win is true update win + 1 */
if ($win) {
    $command = "UPDATE `userstats` SET `wins` = `wins` + 1 WHERE `userID` = ?";
    $stmt = $dbh->prepare($command);
    $params = [$_SESSION["userID"]];
    $check = $stmt->execute($params);
}

//** If loss is true update loss + 1 */
if ($loss) {
    $command = "UPDATE `userstats` SET `losses` = `losses` + 1 WHERE `userID` = ?";
    $stmt = $dbh->prepare($command);
    $params = [$_SESSION["userID"]];
    $check = $stmt->execute($params);
}
