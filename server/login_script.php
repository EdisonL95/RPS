<?php
/**
 * The php script used to handle login requests and create a session for the variables.
 */
include "connect.php";
//** Get the post results from the form, set them as variables and filter/validate the inputs. */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
    //** check if params are ok before adding a user */
    $paramsok = true;

    //** check empty fields */
    if (empty($username) || empty($password)) {
        $paramsok = false;
        header("Location: ../login.php?error=empty");
        exit();
    }

    //** If all params are okay run the check */
    if ($paramsok) {
        //** Select all user information from the user database where the user is the one logging in. */
        $command = "SELECT `userID`, `userPass`, `userNickName`, `userName`  FROM users WHERE `userName` = ?";
        $stmt = $dbh->prepare($command);
        $params = [$username];
        $check = $stmt->execute($params);

        //** If a row is received, means that the username does exist. */
        if ($row = $stmt->fetch()) {
            //** Use password_verify to verify that the user password entered is correct when compared to the hased version.*/
            if (password_verify($password, $row['userPass'])) {
                //** Start a session to get the session variables that are going to be used */
                session_start();
                $_SESSION['userID'] = $row['userID'];
                $_SESSION['userName'] = $row['userName'];
                $_SESSION['userNickName'] = $row['userNickName'];
                //** Redirect the user to the main page. */
                header("Location: ../index.php?");
                exit();
            } else {
                //** Redirect the user and set the url to an error url for the $_GET in login.php */
                header("Location: ../login.php?error=wrongpass");
                exit();
            }
        } else {
            //** Redirect the user and set the url to an error url for the $_GET in login.php */
            header("Location: ../login.php?error=wronguser");
            exit();
        }
    }
}
