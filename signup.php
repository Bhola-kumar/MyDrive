<!DOCTYPE html>
<html>
<head>
  <title>Sign Up</title>
</head>
<body>
  <h1>Sign Up</h1>
  <form method="post" action="signup_process.php">
    <label>Username:</label>
    <input type="text" name="username" required><br>
    <label>Password:</label>
    <input type="password" name="password" required><br>
    <label>Name:</label>
    <input type="text" name="name" required><br>
    <label>Email:</label>
    <input type="email" name="email" required><br>
    <input type="submit" name="signup" value="Sign Up">
  </form>
</body>
</html>
