<?php
// Include your database credentials from "private.php"
include "private.php";

// Create a PDO database connection
$pdo = new PDO("mysql:host=$servername;dbname=$database", $db_username, $db_password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Start a session
session_start();

// Check if a POST request is made
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        // Query to fetch user data based on the username
        $stmt = $pdo->prepare("SELECT user_id, username, password, is_admin, is_enabled FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user["password"])) {
            if ($user["is_enabled"] == 1) {
                if ($user["is_admin"] == 1) {
                    // Admin user is authenticated
                    $_SESSION["user_id"] = $user["user_id"];
                    $_SESSION["username"] = $user["username"];
                    $_SESSION["is_admin"] = true;
                    header("Location: /admin"); // Redirect admin to admin page
                } else {
                    // Regular user is authenticated
                    $_SESSION["user_id"] = $user["user_id"];
                    $_SESSION["username"] = $user["username"];
                    header("Location: /profile"); // Redirect regular user to profile page
                }
            } else {
                echo "Your account is disabled."; // Display a message for disabled accounts
            }
        } else {
            echo "Invalid username or password."; // Display an error message
        }
    } catch (PDOException $e) {
        echo "Login failed: " . $e->getMessage(); // Handle a database connection error
    }
}
?>
