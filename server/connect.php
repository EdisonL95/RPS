<?php

/**
 * The php file used to cconnect to the database.
 */
try {
    $dbh = new PDO(
        "mysql:host=localhost;dbname=edison",
        "root",
        ""
    );
} catch (Exception $e) {
    die("ERROR: Couldn't connect. {$e->getMessage()}");
}
