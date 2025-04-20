<?php
session_start();
$username = $_SESSION['username'] ?? '';
$email = $_SESSION['email'] ?? '';
$password = $_SESSION['password'] ?? '';
$remember = $_SESSION['remember'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Welcome</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Welcome!</h2>
  <div class="table-container">
    <table>
      <tr><td>Username</td><td><?php echo htmlspecialchars($username); ?></td></tr>
      <tr><td>Email</td><td><?php echo htmlspecialchars($email); ?></td></tr>
      <tr><td>Password</td><td><?php echo htmlspecialchars($password); ?></td></tr>
      <tr><td>Remember me?</td><td><?php echo htmlspecialchars($remember); ?></td></tr>
    </table>
  </div>
</body>
</html>
