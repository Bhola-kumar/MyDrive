<?php
// Start a PHP session
session_start();

// Connect to MySQL database
$host = "localhost";
$username = "id20285017_root";
$password = "=3)tw>U=WJvFzbBm";
$dbname = "id20285017_users";

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Process login form data
if (isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Query the "users" table for the entered username and password
  $sql = "SELECT id, name FROM users WHERE username='$username' AND password='$password'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) == 1) {
    // Set session variables for the user ID and name
    $row = mysqli_fetch_assoc($result);
    $_SESSION["user_id"] = $row["id"];
    $_SESSION["user_name"] = $row["name"];

    // Redirect to the user's welcome page
    header("Location: welcome.php");
    exit();
  } else {
    echo "Error: Invalid username or password.";
  }
}

// Close the MySQL database connection
mysqli_close($conn);
?>
