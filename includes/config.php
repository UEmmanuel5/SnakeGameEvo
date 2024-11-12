<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "snake_game";

$conn = new mysqli($server, $username, $password, $dbname);

if (!$conn) {
    echo "Failed To connect to the database!!!";
    exit();
}
