<?php
session_start();

include "../../../includes/config.php";

if (isset($_SESSION["logged-in"]) !== true) {
    header("Location: login.php");
    exit();
}


// Check if the score and username are set in the session
if (!isset($_SESSION['username']) || !isset($_SESSION['score'])) {
    die("Error: Username or score not set in session.");
}

$username = $_SESSION['username'];
$currentScore = $_SESSION['score'];
$playerHighScore = $_SESSION['high_score']; //Gotten from game.php line 33
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Serif:ital,opsz,wght@0,8..144,100..900;1,8..144,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/updatePlayerDetails.css">
    <title>Dashboard</title>
</head>

<body>

    <div class="btn-cont">
        <p>Continue the game &#128527;</p>
        <a href="../../game.php"> <button class="return-btn">Return</button>
        </a>
    </div>

    <section id="playerDetails">
        <article class="top-items">

            <article class="player-img">
                <img src="../../../public/images/player.jpg" alt="player image">
            </article>

            <article class="player-img">
                <h2>Player High Score: <?php echo $playerHighScore ?></h2>
            </article>
            <article>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Current Score</th>
                        </tr>
                    </thead>
                    <tbody><?php

                            $stmt = $conn->prepare("SELECT * FROM player_score WHERE username = ?");
                            $stmt->bind_param("s", $username);
                            $stmt->execute();

                            $result = $stmt->get_result();

                            if ($result && $result->num_rows > 0) {

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $username = $row["username"];
                                    $score = $row["score"];

                                    echo '
                                     <tr>
                                        <td>' . $username . '</td>
                                        <td>' . $score . '</td>
                                     </tr>
                                ';
                                }
                            } else {
                                echo '<div>No data exists!</div>';
                            }


                            ?>
                    </tbody>
                </table>
            </article>
        </article>


    </section>
</body>

</html>