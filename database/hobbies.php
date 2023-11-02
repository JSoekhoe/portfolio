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

        // Check if the new hobby is not empty
        if (!empty($new_hobby)) {
            // Check if an image file has been provided
            $image_name = $_FILES['hobby_image']['name'];
            $image_tmp_name = $_FILES['hobby_image']['tmp_name'];

            if (!empty($image_name) && !empty($image_tmp_name)) {
                // Handle image upload
                $image_type = $_FILES['hobby_image']['type'];

                if (move_uploaded_file($image_tmp_name, "uploads/" . $image_name)) {
                    // Read the image data into a variable
                    $image_data = file_get_contents("uploads/" . $image_name);
                } else {
                    echo "Image upload failed.";
                }
            } else {
                // No image provided, so set image_data and image_type to NULL
                $image_data = null;
                $image_type = null;
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
    $stmt = $pdo->prepare("SELECT hobbies.hobby_id, hobbies.hobby_name, hobby_images.image_data, hobby_images.image_type FROM hobbies LEFT JOIN hobby_images ON hobbies.hobby_id = hobby_images.hobby_id WHERE hobbies.user_id = ?");
    $stmt->execute([$user_id]);
    $hobbies = $stmt->fetchAll(PDO::FETCH_ASSOC);
}