<?php
$servername = "localhost"; // Replace with your MySQL server name or IP address
$username = "root"; // Replace with your MySQL username
$password = "joeriesoekhoe"; // Replace with your MySQL password
$database = "profileApp"; // Replace with your MySQL database name

// Create a connection
$mysqli = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>

