<?php
// Include your database credentials
include "private.php";

$pdo = new PDO("mysql:host=$servername;dbname=$database", $db_username, $db_password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Check if the user is logged in (similar to your hobbies page)


$user_id = $_SESSION['user_id'];

// Function to retrieve school grades
function getSchoolGrades($pdo, $user_id) {
    $stmt = $pdo->prepare("SELECT school_id, school_name, study, class, grade FROM school_grades WHERE user_id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to add a new school grade
function addSchoolGrade($pdo, $user_id, $school_name, $study, $class, $grade) {
    $stmt = $pdo->prepare("INSERT INTO school_grades (user_id, school_name, study, class, grade) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$user_id, $school_name, $study, $class, $grade]);
}

// Function to update a school grade
function updateSchoolGrade($pdo, $user_id, $school_id, $school_name, $study, $class, $grade) {
    $stmt = $pdo->prepare("UPDATE school_grades SET school_name = ?, study = ?, class = ?, grade = ? WHERE school_id = ? AND user_id = ?");
    $stmt->execute([$school_name, $study, $class, $grade, $school_id, $user_id]);
}

// Function to delete a school grade
function deleteSchoolGrade($pdo, $user_id, $school_id) {
    $stmt = $pdo->prepare("DELETE FROM school_grades WHERE school_id = ? AND user_id = ?");
    $stmt->execute([$school_id, $user_id]);
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_grade'])) {
        $school_name = $_POST['school_name'];
        $study = $_POST['study'];
        $class = $_POST['class'];
        $grade = $_POST['grade'];

        if (!empty($school_name) && !empty($study) && !empty($class) && is_numeric($grade)) {
            addSchoolGrade($pdo, $user_id, $school_name, $study, $class, $grade);
        }
    }

    if (isset($_POST['edit_grade'])) {
        $school_id = $_POST['edit_id'];
        $school_name = $_POST['edited_school_name'];
        $study = $_POST['edited_study'];
        $class = $_POST['edited_class'];
        $grade = $_POST['edited_grade'];

        if (!empty($school_name) && !empty($study) && !empty($class) && is_numeric($grade)) {
            updateSchoolGrade($pdo, $user_id, $school_id, $school_name, $study, $class, $grade);
        }
    }

    if (isset($_POST['delete_grade'])) {
        $school_id = $_POST['delete_id'];
        deleteSchoolGrade($pdo, $user_id, $school_id);
    }
}

$schoolGrades = getSchoolGrades($pdo, $user_id);
?>
