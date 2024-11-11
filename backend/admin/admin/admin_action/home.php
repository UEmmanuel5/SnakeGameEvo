<?php
session_start();

include "../../../../includes/config.php";

if (!isset($_SESSION["logged-in-admin"]) || $_SESSION["logged-in-admin"] !== true) {
    header("Location: ../login.php");
}

$admin_name = $_SESSION["admin"];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/admin.png" type="image/x-icon">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Serif:ital,opsz,wght@0,8..144,100..900;1,8..144,100..900&display=swap" rel="stylesheet">

    <!-- Core Styles -->
    <link rel="stylesheet" href="../css/index.css">

    <title>SnakeGameEvo Administration</title>
</head>

<body>
    <header>
        <a href="../index.php"><button class="btn-top sz">Logout</button></a>
    </header>

    <!-- HERO SECTION -->
    <section class="hero">
        <img src="../images/admin-back.jpg" class="snake-bkg" alt="Snake Game Background">
        <div class="hero-content">
            <h1>Welcome to Snake Game Evo Administration</h1>
            <p>Ready to start your adventure <span class="admin"><?php echo strtoupper($admin_name) . '!' ?></span></p>
        </div>
    </section>

    <!-- CONTENT SECTION -->
    <div id="contnent">
        <section class="card-container">
            <div class="card">
                <h2>Card 1</h2>
                <p>Create a new Admin.</p>
                <a href="../createAdmin.php"><button class="btn-top">Create Admin</button></a>
            </div>
            <div class="card">
                <h2>Card 2</h2>
                <p>View the present Admins.</p>
                <a href="viewAdmin.php"><button class="btn-top">view Admin</button></a>
            </div>
            <div class="card">
                <h2>Card 3</h2>
                <p>View the present Players.</p>
                <a href="viewPlayers.php"><button class="btn-top">View PlayerS</button></a>
            </div>
        </section>
    </div>

    <footer>
        <div class="my-info">
            <p>Snake Game Evo was Developed by</p>
            <img src="../images/logo-2.png" alt="my-logo" class="my-logo">
        </div>

        <div class="reference">
            <p>Want to Know more, visit my Repo</p>
            <a href="https://www.github.com/SnakeGameEvo/SnakeGameEvo" target="_blank">
                <img src="../images/github.png" alt="" class="social">
            </a>
        </div>

        <p>copyright &copy; Ugwu Kingsley <span class="year"></span></p>
    </footer>
    <script src="../Js/index.js" type="module"></script>
</body>

</html>