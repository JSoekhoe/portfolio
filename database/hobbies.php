<?php

// Include your database credentials from "private.php"
include "private.php";

$pdo = new PDO("mysql:host=$servername;dbname=$database", $db_username, $db_password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Add a new hobby
    if (isset($_POST['add_hobby'])) {
        $new_hobby = $_POST['new_hobby'];
        $image_data = null;
        $image_type = null;

        // Check if an image file has been provided
        if (!empty($_FILES['hobby_image']['name'])) {
            $image_name = $_FILES['hobby_image']['name'];
            $image_tmp_name = $_FILES['hobby_image']['tmp_name'];
            $image_type = $_FILES['hobby_image']['type'];

            // Handle image upload
            $image_data = file_get_contents($image_tmp_name);
        }

        // Insert the new hobby into the "hobbies" table
        $stmt = $pdo->prepare("INSERT INTO hobbies (user_id, hobby_name) VALUES (?, ?)");
        $stmt->execute([$user_id, $new_hobby]);

        // Insert the image data into the "hobby_images" table (if provided)
        if (!empty($image_data) && !empty($image_type)) {
            $stmt = $pdo->prepare("INSERT INTO hobby_images (hobby_id, image_data, image_type) VALUES (?, ?, ?)");
            $stmt->execute([$pdo->lastInsertId(), $image_data, $image_type]);
        }
    }

    // Edit a hobby
    if (isset($_POST['edit_hobby'])) {
        $edited_hobby_name = $_POST['edited_hobby_name'];
        $edit_id = $_POST['edit_id'];

        // Check if the edited hobby name is not empty
        if (!empty($edited_hobby_name)) {
            // Update the hobby in the "hobbies" table
            $updateStmt = $pdo->prepare("UPDATE hobbies SET hobby_name = ? WHERE hobby_id = ? AND user_id = ?");
            $updateStmt->execute([$edited_hobby_name, $edit_id, $user_id]);
        } else {
            // Hobby name is empty, so delete the hobby
            $deleteStmt = $pdo->prepare("DELETE FROM hobbies WHERE hobby_id = ? AND user_id = ?");
            $deleteStmt->execute([$edit_id, $user_id]);
        }
    }

    // Delete a hobby
    if (isset($_POST['delete_hobby'])) {
        $delete_id = $_POST['delete_id'];
        // Delete the hobby from the "hobbies" table
        $deleteStmt = $pdo->prepare("DELETE FROM hobbies WHERE hobby_id = ? AND user_id = ?");
        $deleteStmt->execute([$delete_id, $user_id]);
    }

    // Retrieve the user's hobbies with associated images
    $stmt = $pdo->prepare("SELECT hobbies.hobby_id, hobbies.hobby_name, hobbies.hobby_description, hobby_images.image_data, hobby_images.image_type FROM hobbies LEFT JOIN hobby_images ON hobbies.hobby_id = hobby_images.hobby_id WHERE hobbies.user_id = ?");
    $stmt->execute([$user_id]);
    $hobbies = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Delete an image
if (isset($_POST['delete_image'])) {
    $image_id = $_POST['delete_image_id'];

    // Delete the image from the "hobby_images" table
    $deleteImageStmt = $pdo->prepare("DELETE FROM hobby_images WHERE hobby_id = ?");
    $deleteImageStmt->execute([$image_id]);
}
// Handle image update
if (isset($_POST['edit_image'])) {
    $edit_image_id = $_POST['edit_image_id'];

    if (!empty($_FILES['new_hobby_image']['name'])) {
        // Check if a new image file has been provided
        $new_image_name = $_FILES['new_hobby_image']['name'];
        $new_image_tmp_name = $_FILES['new_hobby_image']['tmp_name'];
        $new_image_type = $_FILES['new_hobby_image']['type'];

        // Handle image upload for editing
        $new_image_data = file_get_contents($new_image_tmp_name);

        // Update the image data in the "hobby_images" table
        $updateImageStmt = $pdo->prepare("UPDATE hobby_images SET image_data = ?, image_type = ? WHERE hobby_id = ?");
        $updateImageStmt->execute([$new_image_data, $new_image_type, $edit_image_id]);
    }
}
// Add a new description
if (isset($_POST['add_description'])) {
    $new_description = $_POST['new_description'];
    $add_description_id = $_POST['add_description_id'];

    // Update the description in the "hobbies" table
    $updateDescriptionStmt = $pdo->prepare("UPDATE hobbies SET hobby_description = ? WHERE hobby_id = ? AND user_id = ?");
    $updateDescriptionStmt->execute([$new_description, $add_description_id, $user_id]);
}

// Edit a description
if (isset($_POST['edit_description'])) {
    $edited_description = $_POST['edited_description'];
    $edit_id = $_POST['edit_id'];

    // Update the description in the "hobbies" table
    $updateDescriptionStmt = $pdo->prepare("UPDATE hobbies SET hobby_description = ? WHERE hobby_id = ? AND user_id = ?");
    $updateDescriptionStmt->execute([$edited_description, $edit_id, $user_id]);
}

// Delete a description
if (isset($_POST['delete_description'])) {
    $delete_id = $_POST['delete_id'];

    // Delete the description from the "hobbies" table
    $deleteDescriptionStmt = $pdo->prepare("UPDATE hobbies SET hobby_description = NULL WHERE hobby_id = ? AND user_id = ?");
    $deleteDescriptionStmt->execute([$delete_id, $user_id]);
}
?>