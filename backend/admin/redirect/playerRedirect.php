<?php
include "../../../includes/config.php";

echo '<div id="msg">Successfully Connected to the login page. Click <span class="click-h">click here</span></div>';
?>

<style>
    .click-h {
        color: red;
        cursor: pointer;
    }

    .click-h:hover {
        color: skyblue;
    }
</style>

<script>
    const clickNext = document.getElementsByClassName('click-h')[0];

    if (clickNext) {
        clickNext.addEventListener('click', () => {
            // Redirect to the login page
            window.location.href = "../players/login.php";
        });
    }
</script>