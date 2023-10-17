<?php
$App = require 'private.php';
$dbconn = $App['database'];

try {
$conn = new PDO(
"mysql:host=localhost;dbname=profileApp",
'root',
'joeriesoekhoe'
);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch(PDOException $e) {
echo "Connection failed: " . $e->getMessage();
}

$id = $_GET['id'];

$sql = "select * from hobbies where userid = $id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$hobbies = $stmt->fetchAll(PDO::FETCH_ASSOC);

require 'portfolio/view/homepage.php';