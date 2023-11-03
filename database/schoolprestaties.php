<?php
// Include your database credentials from "private.php"
include "private.php";

// Create a PDO database connection
$pdo = new PDO("mysql:host=$servername;dbname=$database", $db_username, $db_password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Get the user's ID from the session
$user_id = $_SESSION['user_id'];

// Function to get a grade by ID from the array
function getGradeById($grades, $id) {
    foreach ($grades as $grade) {
        if ($grade['school_id'] == $id) {
            return $grade;
        }
    }
    return null;
}

// Check if a POST request to add a school grade is made
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['school_name']) && isset($_POST['study']) && isset($_POST['class']) && isset($_POST['grade'])) {
    $school_name = $_POST['school_name'];
    $study = $_POST['study'];
    $class = $_POST['class'];
    $grade = floatval($_POST['grade']);

    // Add a school grade to the database
    $query = "INSERT INTO school_grades (user_id, school_name, study, class, grade) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$user_id, $school_name, $study, $class, $grade]);
}

// Check if a POST request to edit a school grade is made
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_edit'])) {
    $school_id = $_POST['edit_school_id'];
    $edited_school_name = $_POST['edited_school_name'];
    $edited_study = $_POST['edited_study'];
    $edited_class = $_POST['edited_class'];
    $edited_grade = floatval($_POST['edited_grade']);

    // Update the school grade in the database
    $query = "UPDATE school_grades SET school_name = ?, study = ?, class = ?, grade = ? WHERE school_id = ? AND user_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$edited_school_name, $edited_study, $edited_class, $edited_grade, $school_id, $user_id]);
}

// Check if a POST request to delete a school grade is made
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $school_id = $_POST['delete_id'];

    // Delete a school grade from the database
    $query = "DELETE FROM school_grades WHERE school_id = ? AND user_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$school_id, $user_id]);
}

// Retrieve school grades from the database
$query = "SELECT * FROM school_grades WHERE user_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$user_id]);
$grades = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
