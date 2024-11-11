<?php

include "../../../includes/config.php";

$message = "";

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        //Hashing the passowrd
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO admin (name, password) VALUES (?,?)");
        $stmt->bind_param("ss", $username, $hashed_password);

        if ($stmt->execute()) {
            // Redirecting after successful account creation
            header("Location: redirect/adminRedirect.php");
            exit();
        } else {
            $message = "Failed to create the account!!!";  //Handling creating an account error
        }
    } else {
        $message = "Error: Ensure all fields are filled!!!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arvo:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <!-- font awesome begin -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- font awesome end  -->

    <link rel="stylesheet" href="./css/create-2.css">
    <title>Create an Account</title>
    <style>
        .alert {
            color: red;
        }
    </style>
</head>

<body>

    <div class="login-box">
        <h1>Create an Account</h1>

        <!-- Display success/error message -->
        <?php if ($message) : ?>
            <div class="alert"><?php echo $message; ?></div>
        <?php endif; ?>

        <form action="createAdmin.php" method="post">
            <div class=" input1">
                <label for="username">
                    <input type="text" id="username" placeholder="Username" name="username" autocomplete="off" required>
                </label>
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="input2">
                <label for="password">
                    <input type="password" id="password" placeholder="Password" name="password" autocomplete="off" required>
                </label>
                <i class="fa-solid fa-lock"></i>
            </div>

            <div class="input3_forgotpwd">
                <div class="input3">
                    <input type="checkbox" id="remember_me">
                    <label for="remember_me" class="rem">Remember me</label>
                </div>
                <a href="#" class="forgot_password">Forgot Password</a>
            </div>

            <button type="submit" class="submitbtn" name="submit">Submit</button><br>
            <span>Don't have an account yet?</span><a href="#" class="signup">Sign up</a>

        </form>


    </div>

</body>

</html>