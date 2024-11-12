<?php
session_start();
include "../includes/config.php";

// Check if the user is logged in
if (!isset($_SESSION["logged-in"]) || $_SESSION["logged-in"] !== true) {
    header("Location: ./admin/players/login.php");
    exit();
}
$username  = $_SESSION["username"];
$currentScore = $_SESSION['score'];


// Fetch the previous high score from the `high_score` table
$highScoreStmt = $conn->prepare("SELECT high_score FROM high_score WHERE username = ?");
$highScoreStmt->bind_param("s", $username);
$highScoreStmt->execute();
$result = $highScoreStmt->get_result();

$playerHighScore = $currentScore; // Default to current score if no previous high score exists

if ($result && $result->num_rows > 0) {
    // If a previous high score exists, fetch it
    $data = $result->fetch_assoc();
    $previousHighScore = $data["high_score"];

    // Determine the new high score
    if ($currentScore < $previousHighScore) {
        $playerHighScore = $previousHighScore;
    } else {
        $playerHighScore = $currentScore;
    }
    $_SESSION['high_score'] = $playerHighScore;
} else {
    // If no entry exists in high_score, insert one with the current score
    $insertStmt = $conn->prepare("INSERT INTO high_score (username, high_score) VALUES (?, ?)");
    $insertStmt->bind_param("si", $username, $currentScore);
    $insertStmt->execute();
    $insertStmt->close();
}

// Update the high score in the high_score table if the current score is higher
if ($playerHighScore == $currentScore) {
    $updateStmt = $conn->prepare("INSERT INTO high_score (username, high_score) VALUES (?, ?) ON DUPLICATE KEY UPDATE high_score = ?");
    $updateStmt->bind_param("sii", $username, $currentScore, $currentScore);
    $updateStmt->execute();
    $_SESSION["high_score"] = $playerHighScore;  //Storing the player's high score in a session
    $updateStmt->close();
}

$highScoreStmt->close();
// $conn->close();

// Debug output for verification
// echo "Debug: Username - $username, Previous High Score - " . ($previousHighScore ?? 'None') . ", Current Score - $currentScore, New High Score - $playerHighScore";

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
    <!-- <link rel="stylesheet" href="../public/styles/index.css"> -->
    <link rel="stylesheet" href="../public/styles/header.css">
    <link rel="stylesheet" href="../public/styles/game_arena.css">
    <title>Snake Game</title>
</head>

<body>

    <!-- Pass PHP session data to JavaScript -->
    <script>
        const playerNameFromServer = "<?php echo strtoupper($username); ?>";
        const playerHighScoreFromServer = "<?php echo $playerHighScore; ?>";
    </script>

    <header>
        <ul>
            <li>Player: </li> <!-- Leave this blank initially -->
            <li>Player's Score: <?php echo $playerHighScore; ?></li>
            <li>Score: </li>
            <li><img src="../public/images/user.png" alt="user" class="user-img"></li>
        </ul>

        <div class="user-img-toggle">
            <ul>
                <li><a href="./admin/players/updatePlayerDetails.php">Dashboard</a></li>
                <li>
                    <hr>
                </li>
                <li>
                    <hr>
                </li>
                <li>
                    <hr>
                </li>
                <li>
                    <hr>
                </li>
                <li><a href="./admin/players/logout.php"><button>Logout</button></a></li>
            </ul>
        </div>
    </header>

    <div id="goat-scream">
        <audio id="scream-audio">
            <source src="../public/audio/goat_scream.mp3" type="audio/mpeg">
            <source src="horse.ogg" type="audio/ogg">
            Your browser does not support the audio element.
        </audio>
    </div>

    <div id="snake-eats">
        <audio id="eat-audio">
            <source src="../public/audio/goat_scream.mp3" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
    </div>



    <section id="game-cont">
        <canvas id="game-arena"></canvas>
    </section>

    <script src="../public/Js/header.js" type="module"></script>
    <script src="../public/Js/player.js" type="module"></script>
    <script src="../public/Js/game_arena.js" type="module"></script>
    <script src="../public/Js/end_game.js" type="module"></script>

</body>

</html>