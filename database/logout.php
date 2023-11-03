<?php
// Start the session
session_start();

// logging the user out
session_destroy();

// Redirect to the login page
header("Location: /login");
?>

