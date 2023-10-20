<?php
include 'private.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $lastName = $_POST["lastname"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Example using MySQLi:
    $stmt = $mysqli->prepare("INSERT INTO users (name, lastname, username, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss",$name, $lastName, $username, $password);

    if ($stmt->execute()) {
        echo "Registration successful. You can now <a href='../view/login.view.php'>log in</a>.";
    } else {
        echo "Registration failed. Please try again.";
    }
    $stmt->close();
}
?>
