import { checkGameOver } from './end_game.js';
import { updateHeader } from './header.js';
import Player from './player.js';

// Canvas and context setup
const canvas = document.getElementById('game-arena');
const ctx = canvas.getContext('2d');
canvas.width = 600;
canvas.height = 500;
const cellSize = 20;
let currentScore = 0;

// Initialize player
export const player = new Player("Player1");

// Array of colors to cycle through
const colors = ['blue', 'purple', 'orange', 'yellow', 'pink', 'cyan', 'lime', 'red', 'magenta', 'brown'];

// Food class to handle food spawning and display
class Food {
    constructor() {
        this.position = this.generatePosition();
    }

    generatePosition() {
        return {
            x: Math.floor(Math.random() * (canvas.width / cellSize)) * cellSize,
            y: Math.floor(Math.random() * (canvas.height / cellSize)) * cellSize
        };
    }

    draw() {
        ctx.fillStyle = 'red';
        ctx.fillRect(this.position.x, this.position.y, cellSize, cellSize);
    }
}

// Snake class with Head and Body as subclasses
class Snake {
    constructor() {
        this.head = new Head();
        this.body = new Body();
        this.currentDirection = 'ArrowDown';
        this.newDirection = 'ArrowDown';
        this.grow = false; // Flag to indicate if the snake should grow
        this.colorIndex = 0; // Index for color array
    }

    changeDirection(key) {
        if (
            (key === 'ArrowUp' && this.currentDirection !== 'ArrowDown') ||
            (key === 'ArrowDown' && this.currentDirection !== 'ArrowUp') ||
            (key === 'ArrowLeft' && this.currentDirection !== 'ArrowRight') ||
            (key === 'ArrowRight' && this.currentDirection !== 'ArrowLeft')
        ) {
            this.newDirection = key;
        }
    }

    move(food) {
        // Update direction
        this.currentDirection = this.newDirection;

        // Store current head position before it moves (for body growth)
        const oldHeadPosition = { ...this.head.position };

        // Move head and get new head position
        const newHeadPosition = this.head.move(this.currentDirection);

        // Check game over condition
        if (checkGameOver(newHeadPosition, this.body.segments, canvas)) {
            clearInterval(gameLoop);
            currentScore = player.score;
            sendScoreToServer(currentScore); // Send score to server
            alert("Game Over! #### ~~~Refresh This Page to continue ~~~####");
            return;
        }

        // Check if snake eats food
        if (this.head.position.x === food.position.x && this.head.position.y === food.position.y) {
            player.increaseScore(10);
            updateHeader();
            food.position = food.generatePosition(); // Generate new food position
            this.grow = true; // Set the grow flag to true when food is eaten

            // Change color every 100 points
            if (player.score % 100 === 0) {
                this.colorIndex = (this.colorIndex + 1) % colors.length;
            }
        }

        // Add the head's previous position to the body
        this.body.addSegment(oldHeadPosition);

        // If the snake didn't eat, remove the last segment
        if (!this.grow) {
            this.body.removeLastSegment();
        } else {
            this.grow = false; // Reset the grow flag after growing
        }
    }

    draw() {
        this.head.draw(colors[this.colorIndex]); // Pass the color to the head
        this.body.draw(colors[this.colorIndex]); // Pass the color to the body
    }
}

// Head class to manage snake head
class Head {
    constructor() {
        this.position = { x: cellSize * 5, y: cellSize * 5 };
    }

    move(direction) {
        const newPosition = { ...this.position };
        switch (direction) {
            case 'ArrowUp':
                newPosition.y -= cellSize;
                console.log("newPosition:", newPosition, "cellSize: ", cellSize);
                break;
            case 'ArrowDown':
                newPosition.y += cellSize;
                break;
            case 'ArrowLeft':
                newPosition.x -= cellSize;
                break;
            case 'ArrowRight':
                newPosition.x += cellSize;
                break;
        }
        this.position = newPosition;
        return newPosition;
    }

    draw(color) {
        ctx.fillStyle = color;
        ctx.fillRect(this.position.x, this.position.y, cellSize, cellSize);
    }
}

// Body class to manage snake body segments
class Body {
    constructor() {
        this.segments = [];
    }

    addSegment(position) {
        this.segments.unshift({ ...position }); // Add to the front of the array
    }

    removeLastSegment() {
        this.segments.pop(); // Remove the last element
    }

    draw(color) {
        ctx.fillStyle = color;
        this.segments.forEach(segment => {
            ctx.fillRect(segment.x, segment.y, cellSize, cellSize);
        });
    }
}

// Function to send the current score to the server
function sendScoreToServer(score) {
    fetch('../../new_snake_game/backend/admin/players/playerScore.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ score: score }),
    })
        .then(response => response.text()) // Read as text initially to debug
        .then(data => {
            console.log("Raw response:", data); // Check the raw response here
            const jsonData = JSON.parse(data); // Parse JSON after verifying response
            console.log("Score sent successfully:", jsonData);
        })
        .catch(error => {
            console.error("Error sending score:", error);
        });

}

// Function to draw the grid on the canvas
function drawGrid() {
    ctx.beginPath();
    ctx.strokeStyle = 'black';

    for (let x = 0; x <= canvas.width; x += cellSize) {
        ctx.moveTo(x, 0);
        ctx.lineTo(x, canvas.height);
    }
    for (let y = 0; y <= canvas.height; y += cellSize) {
        ctx.moveTo(0, y);
        ctx.lineTo(canvas.width, y);
    }

    ctx.stroke();
    ctx.closePath();
}

// Game initialization
const snake = new Snake();
const food = new Food();
let gameLoop;

// Start the game
function startGame() {
    gameLoop = setInterval(() => {
        ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear canvas
        drawGrid(); // Draw grid on each frame
        snake.move(food); // Move the snake and handle eating food
        snake.draw(); // Draw the snake
        food.draw(); // Draw the food
    }, 200);
}

// Event listener for key presses to change direction
document.addEventListener('keydown', (event) => {
    snake.changeDirection(event.key);
});

// Start the game loop
startGame();
