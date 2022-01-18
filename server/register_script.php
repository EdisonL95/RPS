<?php

/**
 * The php script used to register.
 */

/** Connect to the database */
include "connect.php";
//** Get the post results from the form, set them as variables and filter/validate the inputs. */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
    $nickname = filter_input(INPUT_POST, "nickname", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
    $hash = password_hash($password, PASSWORD_DEFAULT);
    //** check if params are ok before adding a user */
    $paramsok = true;

    //** check empty fields */
    if (empty($username) || empty($nickname) || empty($email) || empty($password)) {
        $paramsok = false;
        header("Location: ../register.php?error=empty");
        exit();
    }


    //** check password legnth */
    if (strlen($password) < 6) {
        $paramsok = false;
        header("Location: ../register.php?error=shortpass");
    }

    //** check username legnth */
    if (strlen($username) < 6) {
        $paramsok = false;
        header("Location: ../register.php?error=shortusername");
    }

    //** check special characters in username/nickname */
    if (preg_match('/[\'!^£$%&*()}{@#~?><>,|=_+¬-]/', $username) || preg_match('/[\'^£$%&*()!}{@#~?><>,|=_+¬-]/', $nickname)) {
        header("Location: ../register.php?error=specialchar");
        return $error;
    }
}

//** If params are ok, then register the user. */
if ($paramsok) {

    //** Check username, nickname and email to see if they already exist by selecting them. */
    $command = "SELECT `userID` FROM users WHERE `userName` = ? OR `userNickName` = ? OR `userEmail` = ?";
    $stmt = $dbh->prepare($command);
    $params = [$username, $nickname, $email];
    $check = $stmt->execute($params);

    //** It exists if it fetches a row. Display an error. */
    if ($row = $stmt->fetch()) {
        header("Location: ../register.php?error=userexists");
        exit();
    } else {
        //** Otherwise insert the user info into the database */
        $command = 'INSERT INTO `users`(`userNickName`, `userName`, `userEmail`, `userPass`) VALUES (?, ?, ?, ?)';
        $stmt = $dbh->prepare($command);
        $params2 = [$nickname, $username, $email, $hash];
        $success = $stmt->execute($params2);

        //** Then create a game record for the user. */
        $command = 'INSERT INTO `userstats`() VALUES ()';
        $stmt = $dbh->prepare($command);
        $params3 = [];
        $success = $stmt->execute($params3);

        //** Show success */
        header("Location: ../register.php?register=success");
        exit();
    }
}
