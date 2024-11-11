<?php
session_start();

include "../../../../includes/config.php";

if (isset($_SESSION["logged-in-admin"]) === true || isset($_SESSION["logged-in-admin"])) {
    // Unset all session variables
    $_SESSION = array();

    // delete the session cookie.
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit();
}
