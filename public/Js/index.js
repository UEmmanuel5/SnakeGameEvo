
//Get the Date
let today = new Date();
let year = today.getFullYear();
let month = today.getMonth() + 1; // Months are zero-based, so add 1
let day = today.getDate();


document.getElementsByClassName("year")[0].innerHTML = year;

document.getElementById("today").innerHTML = `${year}-${month}-${day}`;
