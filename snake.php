<?

session_start();
//Checking if the player was logged IN
if (isset($_SESSION['logged-in']) || isset($_SESSION['logged-in']) === true) {
    header("location: backend/game.php");
    exit();
} else {
    header("Location: https://www.google.com");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bbb</title>
</head>

<body>

</body>

</html>