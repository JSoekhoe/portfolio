<?php
// Include the database credentials from "private.php"
include 'private.php';

// Start a session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input from the form
    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password_repeat = $_POST["password_repeat"];

    if ($password === $password_repeat) {
        // Hash the user's password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {
            // Create a PDO connection
            $pdo = new PDO("mysql:host=$servername;dbname=$database", $db_username, $db_password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare an SQL statement to insert the user into the database
            $stmt = $pdo->prepare("INSERT INTO users (name, lastname, username, password) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $lastname, $username, $hashed_password]);

            echo "Registration successful. You can now <a href='/login'>log in</a>.";
        } catch (PDOException $e) {
            echo "Registration failed. Please try again. Make sure all fields are filled in.";
        }
    } else {
        echo "Passwords do not match. Please try again.";
    }
}
?>
