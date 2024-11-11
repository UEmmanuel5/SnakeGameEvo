<?php
session_start();
include "../../../../includes/config.php";

$id = $_GET["updateid"];
// Fetching the existing admin data based on ID
$sql = "SELECT * FROM admin WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$row = mysqli_fetch_assoc($result);

$db_adminName = $row['name'];
$db_adminPassword = $row['password'];



if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];


    //Handling user input error
    if (empty($name) || empty($password)) {
        echo "Error: Ensure all fields are filled correctly!";
    } else {

        //Obtaining the admin password
        $db_password = $db_adminPassword;

        if ($password === $db_password || password_verify($password, $db_password)) {

            $stmt = $conn->prepare("UPDATE admin SET name=?, password=? WHERE id=?");
            $stmt->bind_param("sss", $name, $db_password, $id);

            //Executing the Query
            if ($stmt->execute()) {
                header("Location: viewAdmin.php");
                exit();
            } else {
                echo "Error: Failed to edit the admin data!";
            }
        } elseif (!empty($password)) {  //code to execute if the user makes changes to the password

            $hashed_password = password_hash($password, PASSWORD_DEFAULT); //hash the text 

            $stmt = $conn->prepare("UPDATE admin SET name=?, password=? WHERE name=?");
            $stmt->bind_param("sss", $name, $db_password, $db_adminName);

            //Executing the Query
            if ($stmt->execute()) {
                header("Location: viewAdmin.php");
                exit();
            } else {
                echo "Error: Failed to edit the admin data!";
                exit();
            }
        } else {
            echo "Invalid admin credentials. Make sure all data are correct and are well filled...";
            exit();
        }
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../../assets/images/logo.png" type="image/x-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Serif:ital,opsz,wght@0,8..144,100..900;1,8..144,100..900&display=swap" rel="stylesheet">

    <!-- Core styles -->
    <link rel="stylesheet" href="../css/update.css">

    <title>Create a User</title>
</head>

<body>

    <div id="form-container">
        <h1>Update the Admin Account</h1>
        <form class="create-form" method="POST">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your name" autocomplete="off" value="<?php echo htmlspecialchars($db_adminName); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter your password" autocomplete="off" value="<?php echo  htmlspecialchars($db_adminPassword); ?>">
            </div>
            <button type="submit" name="submit" class="form-btn">Submit</button>
        </form>
    </div>
</body>

</html>