<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: /login"); // Redirect to the login page if not logged in
    exit();
}

// Include your database credentials from "private.php"
include "private.php";

// Create a PDO database connection
$pdo = new PDO("mysql:host=$servername;dbname=$database", $db_username, $db_password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Get the user ID from the session
$user_id = $_SESSION["user_id"];

try {
    // Perform any necessary actions before deleting the profile
    // (e.g., deleting related records in other tables)

    // Delete the user's profile
    $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->execute([$user_id]);

    // Destroy the session to log out the user
    session_destroy();

    // Redirect to a page after profile deletion
    header("Location: /login");
} catch (PDOException $e) {
    echo "Profile deletion failed: " . $e->getMessage();
}
?>
