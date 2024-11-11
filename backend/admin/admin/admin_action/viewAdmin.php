<?php
session_start();
include "../../../../includes/config.php";

if (!isset($_SESSION["logged-in-admin"]) || $_SESSION["logged-in-admin"] !== true) {
    header("Location: ../login.php");
}

$admin_name = $_SESSION["admin"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/admin.png" type="image/x-icon">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Serif:ital,opsz,wght@0,8..144,100..900;1,8..144,100..900&display=swap" rel="stylesheet">

    <!-- Core styles -->
    <link rel="stylesheet" href="../css/update.css">
    <style>
        .view-users-title {
            text-align: center;
            margin-top: 12px;
            text-decoration: 6px underline;
        }
    </style>
    <title>view admins</title>
</head>

<body>
    <div id="view-container">
        <h1 class="view-users-title">ADMINS</h1>
        <table class="table">
            <thead>
                <tr>
                    <td class="data-info">#</td>
                    <td class="data-info">NAME</td>
                    <td class="data-info">PASSWORD</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM admin";
                $result = $conn->query($sql);
                if ($result && $result->num_rows > 0) {

                    //Used to orderly display the user numbers
                    $userSerial_no = 1;

                    while ($row = mysqli_fetch_assoc($result)) {
                        $name = $row['name'];
                        $password = $row['password'];
                        $id = $row['id'];

                        //Outputing the data from the database
                        echo '<tr>
                                <td class="data-info">' . $userSerial_no . '</td>
                                <td class="data-info">' . $name . '</td>
                                <td class="data-info">' . $password . '</td>

                                <td class="btn-data-info">
                                    <button class="btn-primary"><a href="updateAdmin.php?updateid=' . $id . '" class="text-light">Update</a></button>
                                    <button class="btn-danger"><a href="deleteAdmin.php?deleteid=' . $id . '" class="text-light">Delete</a></button>
                                </td>
                        </tr>';

                        $userSerial_no++;
                    }
                } else {
                    echo "Error: Unfortunately, No user was found in the Database.";
                }

                ?>
            </tbody>
        </table>
    </div>
</body>

</html>