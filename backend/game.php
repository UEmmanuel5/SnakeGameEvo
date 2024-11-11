<?php

session_start();
include "../includes/config.php";
//Checking if the user is logged in successfully
if (isset($_SESSION["logged-in"]) !== true || !isset($_SESSION["logged-in"])) {
    header("Location: ./admin/players/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/styles/header.css">
    <link rel="stylesheet" href="../public/styles/game_arena.css">
    <title>Snake Game</title>
</head>

<body>
    <header>
        <ul>
            <li>Player: </li>
            <li>Score: </li>
            <li><img src="../public/images/user.png" alt="user" class="user-img"></li>
        </ul>

        <div class="user-img-toggle">
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li>
                    <hr>
                </li>
                <li><a href="#">Preferences</a></li>
                <li>
                    <hr>
                </li>
                <li><a href="#"><button>Logout</button></a></li>
            </ul>
        </div>
    </header>
    <section id="game-cont">
        <canvas id="game-arena">
        </canvas>
    </section>
    <script src="../public/Js/header.js" type="module"></script>
    <script src="../public/Js/player.js" type="module"></script>
    <script src="../public/Js/game_arena.js" type="module"></script>
    <script src="../public/Js/end_game.js" type="module"></script>

</body>

</html>