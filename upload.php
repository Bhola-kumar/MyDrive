<?php
// Start the PHP session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
  exit();
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Connect to MySQL database
  $host = "localhost";
  $username = "id20285017_root";
  $password = "=3)tw>U=WJvFzbBm";
  $dbname = "id20285017_users";

  $conn = mysqli_connect($host, $username, $password, $dbname);
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Get the user ID and uploaded file information
  $user_id = $_SESSION["user_id"];
  $file_name = $_FILES["file"]["name"];
  $file_tmp = $_FILES["file"]["tmp_name"];


  // Check if file already exists for user
  $check_query = "SELECT * FROM files WHERE user_id = '$user_id' AND file_name = '$file_name'";
  $check_result = mysqli_query($conn, $check_query);

  if (mysqli_num_rows($check_result) > 0) {
    $message = "File with the same name already exists. Please choose a different file name.";
  } 
  else {
    // File does not exist, insert new record into database
    $insert_query = "INSERT INTO files (user_id, file_name) VALUES ('$user_id', '$file_name')";
    mysqli_query($conn, $insert_query);

    // Upload file to server
    move_uploaded_file($file_tmp, "uploads/" . $file_name);

    $message = "File uploaded successfully.";
  }

  // Close the MySQL database connection
  mysqli_close($conn);

  // Redirect the user back to the welcome page
  header("Location: welcome.php?message=$message");
  // include 'welcome.php';
  exit();
}
?>





<!DOCTYPE html>
<html>
<head>
  <title>Upload a File</title>
</head>
<body>

  <h1>Upload a File</h1>

  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
    <label for="file">Select a file:</label>
    <input type="file" name="file" id="file" required>
    <br><br>
    <input type="submit" value="Upload">
  </form>

  <p><a href="welcome.php">Back to Welcome Page</a></p>

</body>
</html>

