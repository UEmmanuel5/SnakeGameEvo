import { player } from './game_arena.js';

// Function to update header display with player info
export function updateHeader() {
    // Display the player name and score in the HTML
    document.querySelector('header ul li:nth-child(1)').textContent = `Player: ${player.name}`;
    document.querySelector('header ul li:nth-child(2)').textContent = `Score: ${player.score}`;
}

// Initial display on page load
updateHeader();

// Dropdown menu functionality for user image
const toggleUserImg = document.getElementsByClassName("user-img-toggle")[0];
const userImg = document.getElementsByClassName("user-img")[0];
let flag = false;

// Makes the menu dropdown close if we click outside of the menu
document.addEventListener("click", (event) => {
    if (!toggleUserImg.contains(event.target) && !userImg.contains(event.target)) {
        toggleUserImg.classList.remove("show");
    }
});

// Toggle the dropdown menu when the user image is clicked
userImg.addEventListener("click", () => {
    toggleUserImg.classList.toggle('show');
});
