<?php
session_start();
var_dump($_SESSION["logged-in"], $_SESSION["username"], $_POST, file_get_contents("php://input"));

// Adjust the path to config.php if needed
include "../../../includes/config.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

// Retrieve raw input and decode JSON
$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

// Debugging output
var_dump($_SESSION["logged-in"]);
var_dump($_SESSION["username"]);
var_dump($data);

if (isset($_SESSION["logged-in"]) && $_SESSION["logged-in"] === true && isset($data['score'])) {
    $username = $_SESSION["username"];
    $score = $data['score'];

    $stmt = $conn->prepare("INSERT INTO player_score (username, score) VALUES (?, ?) ON DUPLICATE KEY UPDATE score = ?");
    $stmt->bind_param("sii", $username, $score, $score);

    if ($stmt->execute()) {
        $_SESSION["score"] = $score;
        echo json_encode(["status" => "success", "score" => $score]);
    } else {
        error_log("Database Error: " . $stmt->error);
        echo json_encode(["status" => "error", "message" => "Failed to update score in database"]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "User not logged in or invalid score data"]);
}

exit();
