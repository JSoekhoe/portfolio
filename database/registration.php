<?php
include 'private.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password_repeat = $_POST["password_repeat"];

    try {
        // Create a PDO connection
        $pdo = new PDO("mysql:host=$servername;dbname=$database", $db_username, $db_password);;
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare an SQL statement to insert the user into the database
        $stmt = $pdo->prepare("INSERT INTO users (name, lastname, username, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $lastname, $username, $password]);

        echo "Registration successful. You can now log in.";
    } catch (PDOException $e) {
        echo "Registration failed: " . $e->getMessage();
    }
} else {
    echo "Passwords do not match. Please try again.";
}

?>
