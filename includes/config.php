<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "snake_game";

$conn = new mysqli($server, $username, $password, $dbname);

if (!$conn) {
    echo "Failed To connect to the database!!!";
} else {
    echo '<div id="msg">Successfully connected to the database!!!</div>';
}

?>

<script>
    const msg = document.getElementById('msg');

    if (msg) {
        setTimeout(() => {
            msg.style.display = "none";
        }, 200);
    }
</script>