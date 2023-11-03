<?php
// Include your database credentials from "private.php"
include "private.php";
?>
<link href="../css/profileapp.css" rel="stylesheet" integrity="" crossorigin="anonymous"/>
<?php
// Start a session
session_start();

// Check if a POST request is made
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        // Create a PDO connection
        $pdo = new PDO("mysql:host=$servername;dbname=$database", $db_username, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Query to fetch user data based on the username and password
        $stmt = $pdo->prepare("SELECT user_id, username FROM users WHERE username = ? AND password = ?");
        $stmt->execute([$username, $password]);
        $user = $stmt->fetch();

        if ($user) {
            // User is authenticated, store user data in session
            $_SESSION["user_id"] = $user["user_id"];
            $_SESSION["username"] = $user["username"];
            header("Location: /profile"); // Redirect to a secure page (e.g., user's profile)
        } else {
            echo "Invalid username or password."; // Display an error message
        }
    } catch (PDOException $e) {
        echo "Login failed: " . $e->getMessage(); // Handle a database connection error
    }
}
?>
