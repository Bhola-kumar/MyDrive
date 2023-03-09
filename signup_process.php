<?php
// Connect to MySQL database
$host = "localhost";
$username = "id20285017_root";
$password = "=3)tw>U=WJvFzbBm";
$dbname = "id20285017_users";

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Process sign up form data
if (isset($_POST["signup"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $name = $_POST["name"];
  $email = $_POST["email"];

  // Check if the username is already taken
  $sql = "SELECT id FROM users WHERE username='$username'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    echo "Error: Username already taken.";
  } else {
    // Insert the user's data into the "users" table
    $sql = "INSERT INTO users (username, password, name, email) VALUES ('$username', '$password', '$name', '$email')";
    if (mysqli_query($conn, $sql)) {
      echo "Sign up successful. <a href='login.php'>Login here</a>.";
    } else {
      echo "Error: " . mysqli_error($conn);
    }
  }
}

// Close the MySQL database connection
mysqli_close($conn);
?>
