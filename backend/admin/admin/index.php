<?php
session_start();

include "../../../includes/config.php";

$message = "";

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        // Prepare the statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM admin WHERE name = ?");
        $stmt->bind_param("s", $username);
        echo "help me====";
        if ($stmt->execute()) {
            // Capture the data from the database
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $admin = $result->fetch_assoc();
                $dbPassword = $admin['password'];

                // Verify the password
                if (password_verify($password, $dbPassword)) {
                    // Set session variables
                    session_regenerate_id(true);
                    $_SESSION["session_token"] = bin2hex(random_bytes(32)); // Generate a secure random token
                    $_SESSION['admin'] = $admin['name'];
                    $_SESSION['logged-in-admin'] = true;

                    // Redirect to the game page
                    header("Location: ./admin_action/home.php");
                    exit();
                } else {
                    $message = "Incorrect Password. Please try again.";
                }
            } else {
                $message = "admin does not exist. Please check your username.";
            }
        } else {
            $message = "Database query failed. Please try again.";
        }
    } else {
        $message = "Please ensure all fields are filled!";
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

    <link rel="stylesheet" href="./css/login.css">
    <title>Login</title>
    <style>
        .alert {
            color: red;
        }
    </style>
</head>

<body>

    <div class="login-box">
        <h1>Login</h1>

        <!-- Display success/error message -->
        <?php if ($message) : ?>
            <div class="alert"><?php echo $message; ?></div>
        <?php endif; ?>

        <form action="index.php" method="post">
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

            <button type="submit" class="submitbtn" name="submit">Login</button><br>
            <span>Don't have an account yet?</span><a href="createAdmin.php" class="signup">Sign up</a>

        </form>


    </div>

</body>

</html>