<?php

include "../../../../includes/config.php";

if (isset($_GET['deleteid'])) {
    $serial_no = $_GET['deleteid'];

    $sql = "DELETE FROM admin WHERE id='$serial_no'";

    $result = $conn->query($sql);

    if ($result === TRUE) {

        // include "logout.php";
        header("Location: viewAdmin.php");
    } else {
        echo "Error: " . $sql . "<br>" . $result->error;
    }
}
