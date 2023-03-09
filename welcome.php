<?php
// Start the PHP session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
  exit();
}

// Connect to MySQL database
$host = "localhost";
$username = "id20285017_root";
$password = "=3)tw>U=WJvFzbBm";
$dbname = "id20285017_users";

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get the user ID
$user_id = $_SESSION["user_id"];

// Retrieve the user's profile information from MySQL database
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Display the user's profile information
echo "<h1>Welcome " . $row["name"] . "!</h1>";
echo "<p>Your email is: " . $row["email"] . "</p>";


// Display a link to upload a new file
echo "<p><a href='upload.php'>Upload a File</a></p>";

// echo $message; 

if(isset($_SESSION['message'])) {
  $message = $_GET['message'];
  echo $_SESSION['message'];
  unset($_SESSION['message']);
}

// Retrieve the user's files from MySQL database
$sql = "SELECT * FROM files WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);

// Display the user's files in a table
if (mysqli_num_rows($result) > 0) {
  echo "<table>";
  echo "<tr><th>File Name</th><th>Preview</th><th>Download Link</th></tr>";
  while ($row = mysqli_fetch_assoc($result)) {
    $file_name = $row["file_name"];
    $file_url = "uploads/" . $file_name;
    $file_extension = strtolower(pathinfo($file_url,PATHINFO_EXTENSION));
    if(in_array($file_extension, array("jpg", "jpeg", "png", "gif"))) {
      echo "<tr><td>" . $file_name . "</td><td><img src='" . $file_url . "' height='50' /></td><td><a href='" . $file_url . "'>Download</a></td></tr>";
    } else {
      echo "<tr><td>" . $file_name . "</td><td></td><td><a href='" . $file_url . "'>Download</a></td></tr>";
    }
  }
  echo "</table>";
} else {
  echo "No files uploaded.";
}

// Close the MySQL database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>welcomehtml</title>
</head>
<body>
  <nav>
    <form method="POST" action="logout.php">
      <input type="submit" value="Logout" name="logout">
    </form>
  </nav>
</body>
</html>


