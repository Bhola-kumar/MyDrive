<?php
// Start the session
session_start();

// Check if the user is logged in
// if (!isset($_SESSION["user_id"])) {
//     // If user is not logged in, redirect to login page
//     header("Location: login.php");
//     exit();
//   }

// If user clicks the logout button
if (isset($_POST["logout"])) {
    // Check if the user is logged in
    if (!isset($_SESSION["user_id"])) {
        // If user is not logged in, redirect to login page
        header("Location: login.php");
        exit();
    }
  // Destroy the session and redirect to login page
  session_destroy();
  header("Location: login.php");
  exit();
}

?>

