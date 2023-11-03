<?php
// Include your database credentials from "private.php"
include "private.php";

// Create a PDO database connection
$pdo = new PDO("mysql:host=$servername;dbname=$database", $db_username, $db_password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Get the user's ID from the session
$user_id = $_SESSION['user_id'];

// Function to convert date to European format (DD-MM-YYYY)
function convertToEuropeanDate($date) {
    $dateObj = new DateTime($date);
    return $dateObj->format('d-m-Y');
}

// Check if a POST request to add work experience is made
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['company']) && isset($_POST['job_title']) && isset($_POST['start_date']) && isset($_POST['end_date'])) {
    $company = $_POST['company'];
    $job_title = $_POST['job_title'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Add work experience to the database
    $query = "INSERT INTO work_experience (user_id, company, job_title, start_date, end_date) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$user_id, $company, $job_title, $start_date, $end_date]);
}

// Check if a POST request to edit work experience is made
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_edit'])) {
    $experience_id = $_POST['edit_id'];
    $edited_company = $_POST['edited_company'];
    $edited_job_title = $_POST['edited_job_title'];
    $edited_start_date = $_POST['edited_start_date'];
    $edited_end_date = $_POST['edited_end_date'];

    // Update work experience in the database
    $query = "UPDATE work_experience SET company = ?, job_title = ?, start_date = ?, end_date = ? WHERE id = ? AND user_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$edited_company, $edited_job_title, $edited_start_date, $edited_end_date, $experience_id, $user_id]);
}

// Check if a POST request to delete work experience is made
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $experience_id = $_POST['delete_id'];

    // Delete work experience from the database
    $query = "DELETE FROM work_experience WHERE id = ? AND user_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$experience_id, $user_id]);
}

// Retrieve work experience from the database
$query = "SELECT * FROM work_experience WHERE user_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$user_id]);
$workExperiences = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
