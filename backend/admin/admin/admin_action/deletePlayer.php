<?php

include "../../../../includes/config.php";

if (isset($_GET['deleteid'])) {
    $serial_add = $_GET['deleteid'];

    $sql = "DELETE FROM create_player_account WHERE username='$serial_add'";

    $result = $conn->query($sql);

    if ($result === TRUE) {

        // include "logout.php";
        header("Location: viewAdmin.php");
    } else {
        echo "Error: " . $sql . "<br>" . $result->error;
    }
}
