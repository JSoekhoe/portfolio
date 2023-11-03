<?php

// Function to check if the user is an admin
function isAdmin() {
    if (isset($_SESSION["user_id"])) {
        // Include your database credentials from "private.php"
        include "private.php";

        // Create a PDO database connection
        $pdo = new PDO("mysql:host=$servername;dbname=$database", $db_username, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch the role of the logged-in user
        $user_id = $_SESSION["user_id"];
        $query = "SELECT is_admin FROM users WHERE user_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the role is "admin"
        return $user && $user["is_admin"];
    }

    return false;
}

$users = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user is an admin
    if (isAdmin()) {
        // Include your database credentials from "private.php"
        include "private.php";

        // Create a PDO database connection
        $pdo = new PDO("mysql:host=$servername;dbname=$database", $db_username, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Handle form submissions to enable or disable users
        if (isset($_POST['user_id']) && isset($_POST['action'])) {
            $user_id = $_POST['user_id'];
            $action = $_POST['action'];

            // Update the user's status in the database based on the action
            if ($action === 'enable') {
                // Set the status to 1 (enabled)
                $newStatus = 1;
            } elseif ($action === 'disable') {
                // Set the status to 0 (disabled)
                $newStatus = 0;
            }

            // Update the user's status in the database
            $query = "UPDATE users SET is_enabled = ? WHERE user_id = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$newStatus, $user_id]);
        }
    } else {
        echo "You do not have permission to access this page.";
    }
}

// Fetch the list of users with their statuses
// Place this code outside the if ($_SERVER['REQUEST_METHOD'] === 'POST') block
// So it fetches users regardless of whether a form is submitted
// Create a new PDO connection for this query
include "private.php";
$pdo = new PDO("mysql:host=$servername;dbname=$database", $db_username, $db_password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query = "SELECT user_id, username, is_enabled FROM users";
$stmt = $pdo->query($query);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
