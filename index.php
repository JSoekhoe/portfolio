<?php
$App = require 'database/private.php';
$dbconn = $App['database'];


$routes = [
"/about" => "view/aboutuspage.php",
"/opdrachten" => "view/opdrachtenpage.php",
"/" => "../view/homepage.php",
];
require "view/homepage.php";
try {
    $conn = new PDO(
        "mysql:host=$dbconn[servername];dbname=$dbconn[dbname]",
        $dbconn['username'],
        $dbconn['drowssap']
    );
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$sql = "SELECT * FROM users" ;
$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
