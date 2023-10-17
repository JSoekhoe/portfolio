<?php
$App = require 'database/private.php';
$dbconn = $App['database'];

try {
    $conn = new PDO(
        "mysql:host=localhost;dbname=profileapp",
        'root',
        'joeriesoekhoe'
    );
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$id = $_GET['id'];

$sql = "select * from hobbies where userid = $id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$hobbies = $stmt->fetchAll(PDO::FETCH_ASSOC);

require 'view/homepage.view.php';