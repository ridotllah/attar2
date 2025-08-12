<?php
session_start ();
if(isset ($_SESSION['user'])) {
  header (header: "Location: Welcome.php");
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Form</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <div class="login-container">
    <h2>Login</h2>
    <div class="login-box">

      <form action="auth.php" method="POST">
        <label for="username">Username</label>
        <div class="input-group">
          <input type="text" name="username" id="username" placeholder="Username" required>
        </div>

        <label for="password">Password</label>
        <div class="input-group">
          <input type="password" name="password" id="password" placeholder="Password" required>
        </div>

        <button type="submit" class="login-btn">Login</button>
      
      </form>
    </div>
  </div>

  
</body>
</html>