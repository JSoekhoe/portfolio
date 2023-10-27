<?php

include "private.php";

include "private.php"; // Include your database credentials

$pdo = new PDO("mysql:host=$servername;dbname=$database", $db_username, $db_password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Add a new hobby
    if (isset($_POST['add_hobby'])) {
        $new_hobby = $_POST['new_hobby'];
        // Insert the new hobby into the "hobbies" table
        $stmt = $pdo->prepare("INSERT INTO hobbies (user_id, hobby_name) VALUES (?, ?)");
        $stmt->execute([$user_id, $new_hobby]);
    }

    // Edit a hobby
    if (isset($_POST['edit_hobby'])) {
        $edited_hobby_name = $_POST['edited_hobby_name'];
        $edit_id = $_POST['edit_id'];
        // Update the hobby in the "hobbies" table
        $updateStmt = $pdo->prepare("UPDATE hobbies SET hobby_name = ? WHERE hobby_id = ? AND user_id = ?");
        $updateStmt->execute([$edited_hobby_name, $edit_id, $user_id]);
    }

    // Delete a hobby
    if (isset($_POST['delete_hobby'])) {
        $delete_id = $_POST['delete_id'];
        // Delete the hobby from the "hobbies" table
        $deleteStmt = $pdo->prepare("DELETE FROM hobbies WHERE hobby_id = ? AND user_id = ?");
        $deleteStmt->execute([$delete_id, $user_id]);
    }

    // Retrieve the user's hobbies
    $stmt = $pdo->prepare("SELECT hobby_id, hobby_name FROM hobbies WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $hobbies = $stmt->fetchAll(PDO::FETCH_ASSOC);
}