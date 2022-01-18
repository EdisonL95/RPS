<?php
/**
 * The php script used to logout. It starts a session and then destroys all the session variables and redirects you to the home.
 */
session_start();
unset($_SESSION["userID"]);
unset($_SESSION["userName"]);
unset($_SESSION["userNickName"]);
header("Location:../index.php");
