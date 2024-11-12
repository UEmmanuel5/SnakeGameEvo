class Player {
    constructor(name) {
        this.name = name;
        this.high_score = playerHighScoreFromServer;
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

    // Method to get player details as an object
    getDetails() {
        return {
            name: this.name,
            score: this.score
        };
    }
}

export default Player;
