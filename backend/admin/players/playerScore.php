<?php
session_start();
include "../../../includes/config.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set the response header to JSON
header('Content-Type: application/json');

// Retrieve and decode the JSON input from JavaScript
$data = json_decode(file_get_contents("php://input"), true);

if (isset($_SESSION["logged-in"]) && $_SESSION["logged-in"] === true && isset($data['score'])) {
    $username = $_SESSION["username"];
    $score = $data['score'];

    // Insert or update the score in the database
    $stmt = $conn->prepare("INSERT INTO player_score (username, score) VALUES (?, ?) ON DUPLICATE KEY UPDATE score = ? ");
    $stmt->bind_param("sii", $username, $score, $score);

    if ($stmt->execute()) {
        // Store score in session
        $_SESSION["score"] = $score;
        // Respond back with JSON
        echo json_encode(["status" => "success", "score" => $score]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update score in database"]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "User not logged in or invalid score data"]);
}

exit();
