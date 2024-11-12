<?php

session_start();

include "./includes/config.php";

//Checking if the player was logged IN
if (isset($_SESSION['logged-in']) || isset($_SESSION['logged-in']) === true) {
    header("location: backend/game.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Serif:ital,opsz,wght@0,8..144,100..900;1,8..144,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./public/styles/index.css">
    <title>Snake Game</title>
</head>

<body>
    <header>
        <ul>
            <li>SNAKE <span class="in-text">GAME</span> EVO</li>
            <li>Player <span class="in-text">X</span> <br>Date: <span id="today"></span></li>
        </ul>
    </header>
    <section class="hero">
        <img src="./public/images/landing-background.png" class="snake-bkg" alt="Snake Game Background">
        <div class="hero-content">
            <h1>Welcome to Snake Game Evo</h1>
            <p>Ready to start your adventure!</p>
            <a href="./backend/game.php"><button class="btn-top">Begin</button></a>
        </div>
    </section>

    <section class="intro">
        <div class="intro-content">
            <h2 class="intro-title">Welcome to Snake Game Evo!</h2>
            <p class="intro-text">
                <strong>Snake Game Evo</strong> is a modern twist on the classic snake game. Get ready for an exciting and colorful journey as you guide the snake through a dynamic grid, collecting food and racking up points. With each piece of food the snake eats, it grows longer, increasing the challenge as you try to avoid walls and your own tail. It's a game of skill, reflexes, and strategy!
            </p>

            <h3 class="intro-subtitle">How to Play</h3>
            <ul class="intro-list">
                <li><strong>Movement</strong>: Control the snake using the arrow keys (<span class="in-text">Note: this game works only on a PC</span>).</li>
                <li><strong>Objective</strong>: Collect as much food as possible to grow the snake and increase your score.</li>
                <li><strong>Avoid Obstacles</strong>: The game ends if the snake runs into a wall or its own body.</li>
            </ul>

            <h3 class="intro-subtitle">Scoring</h3>
            <ul class="intro-list">
                <li><strong>Each Food Item</strong>: Earns 10 points, allowing you to gradually build up your score.</li>
                <li><strong>Milestones</strong>: Reach 100 points to trigger a special color change! This will continue every 100 points, giving the snake a new vibrant color to celebrate your progress.</li>
            </ul>

            <h3 class="intro-subtitle">Visual Elements</h3>
            <p class="intro-text">The snake’s color evolves as you play. Every time you reach a score interval of 100 points (100, 200, 300, etc.), the snake adopts a fresh, exciting color, adding to the thrill of reaching new milestones.</p>

            <h3 class="intro-subtitle">Technology Stack</h3>
            <ul class="intro-list">
                <li><strong>Frontend</strong>: HTML, CSS, and JavaScript provide the structure, style, and interactivity of the game.</li>
                <li><strong>Styling</strong>: Bootstrap is used for layout and responsive design, while custom Google Fonts add unique typography. FontAwesome icons are integrated for additional visuals.</li>
                <li><strong>Backend</strong>: PHP and MySQL manage player data, including scores and player profiles.</li>
                <li><strong>Development Environment</strong>: XAMPP serves as the local development environment, allowing for easy MySQL database management.</li>
            </ul>

            <p class="intro-footer">Jump into the game and see how high you can score. Can you hit 500 points? Let the color evolution begin with each new milestone!</p>
        </div>
    </section>


    <section id="cont">
        <h3>See A Demo Below</h3>
        <article class="demo-video">

            <video controls>
                <source src="./public/videos/demo_video.mp4" type="video/mp4">
                <source src="movie.ogg" type="video/ogg">
                Your browser does not support the video tag.
            </video>
        </article>

        <article class="get-started">
            <div class="begin">
                <p>Ready to Start!</p>
                <a href="./backend/game.php">
                    <button class="btn">Begin</button>
                </a>
            </div>
        </article>
    </section>

    <article class="top-items">
        <h1>HIGH <span class="in-text-2">SCORE</span> LIST OF PLAYERS</h1>
        <table>
            <thead>
                <tr>
                    <th class="tab-title">Name</th>
                    <th class="tab-title">score</th>
                </tr>
            </thead>
            <tbody><?php

                    $stmt = "SELECT * FROM high_score";
                    $result = $conn->query($stmt);

                    if ($result && $result->num_rows > 0) {

                        while ($row = mysqli_fetch_assoc($result)) {
                            $username = $row["username"];
                            $score = $row["high_score"];

                            echo '
                                     <tr>
                                        <td class="data-siz">' . $username . '</td>
                                        <td class="data-siz">' . $score . '</td>
                                     </tr>
                                ';
                        }
                    }


                    ?>
            </tbody>
        </table>
    </article>

    <footer>
        <div class="my-info">
            <p>Snake Game Evo was Developed by</p>
            <img src="./public/images/logo-2.png" alt="my-logo" class="my-logo">
        </div>

        <div class="reference">
            <p>Want to Know more, visit my Repo</p>
            <a href="https://www.github.com/SnakeGameEvo/SnakeGameEvo" target="_blank">
                <img src="./public/images/github.png" alt="" class="social">
            </a>
        </div>

        <p>copyright &copy; Ugwu Kingsley <span class="year"></span></p>
    </footer>
    <script src="./public/Js/index.js" type="module"></script>
</body>

</html>