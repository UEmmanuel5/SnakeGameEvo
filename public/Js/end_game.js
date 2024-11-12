let snake_scream = document.getElementById("scream-audio"); // Select the audio element directly

export function checkGameOver(snakeHead, snakeBody, canvas) {
    // Check if the snake's head hits the canvas boundaries
    if (
        snakeHead.x < 0 ||
        snakeHead.x >= canvas.width ||
        snakeHead.y < 0 ||
        snakeHead.y >= canvas.height
    ) {
        // Play the audio when the snake hits the wall
        snake_scream.play();

        alert("Game Over! The snake hit the wall.");
        return true; // Game over due to wall collision
    }

    // Check if the snake's head collides with its body
    for (let segment of snakeBody) {
        if (snakeHead.x === segment.x && snakeHead.y === segment.y) {
            // Play the audio when the snake collides with itself
            snake_scream.play();
            alert("Game Over! The snake collided with itself.");
            return true; // Game over due to self-collision
        }
    }

    return false;
}
