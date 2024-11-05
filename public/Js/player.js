class Player {
    constructor(name) {
        this.name = name;
        this.score = 0;
    }

    // Method to increase score
    increaseScore(points) {
        this.score += points;
    }

    // Method to reset score
    resetScore() {
        this.score = 0;
    }

    // Method to get player details as an object (for potential backend usage)
    getDetails() {
        return {
            name: this.name,
            score: this.score
        };
    }
}

export default Player;
