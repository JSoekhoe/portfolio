<?php
include 'private.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Fetch user data from the database based on the username
    // Use prepared statements to prevent SQL injection

    // Example using MySQLi:
    $stmt = $mysqli->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($user_id, $user, $db_password);
    $stmt->fetch();
    $stmt->close();

    // Check if the provided password matches the stored password
    if ($password == $db_password) {
        $_SESSION["user_id"] = $user_id;
        $_SESSION["username"] = $user;
        header("Location: /dashboard"); // Redirect to a secure page
    } else {
        echo "Invalid username or password.";
    }
}
?>
