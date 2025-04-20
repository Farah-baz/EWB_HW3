<?php
session_start();

$usernameErr = $emailErr = $passwordErr = "";
$username = $email = $password = "";
$remember = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $valid = true;

  if (empty($_POST["username"])) {
    $usernameErr = "Username is required.";
    $valid = false;
  } elseif (!preg_match("/^[a-zA-Z0-9]{8,}$/", $_POST["username"])) {
    $usernameErr = "Only letters and numbers, min 8 characters.";
    $valid = false;
  } else {
    $username = $_POST["username"];
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required.";
    $valid = false;
  } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $emailErr = "Invalid email format.";
    $valid = false;
  } else {
    $email = $_POST["email"];
  }

  if (empty($_POST["password"])) {
    $passwordErr = "Password is required.";
    $valid = false;
  } elseif (!preg_match("/^(?=.*[A-Za-z])(?=.*\\d)(?=.*[^A-Za-z\\d]).{8,}$/", $_POST["password"])) {
    $passwordErr = "Password must contain letters, numbers, and special characters.";
    $valid = false;
  } else {
    $password = $_POST["password"];
  }

  $remember = isset($_POST['remember']) ? 'Checked' : 'Not Checked';

  if ($valid) {
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    $_SESSION['remember'] = $remember;
    header("Location: welcome.php");
    exit();
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>SIGN UP</title>
  <link rel="stylesheet" href="style.css">
  <script>
    function validateForm() {
      let username = document.forms["signupForm"]["username"].value;
      let email = document.forms["signupForm"]["email"].value;
      let password = document.forms["signupForm"]["password"].value;
      let valid = true;

      if (!/^[a-zA-Z0-9]{8,}$/.test(username)) {
        alert("Username must be letters/numbers only and at least 8 characters.");
        valid = false;
      }
      if (!/^\S+@\S+\.\S+$/.test(email)) {
        alert("Invalid email format.");
        valid = false;
      }
      if (!/^(?=.*[A-Za-z])(?=.*\d)(?=.*[^A-Za-z\d]).{8,}$/.test(password)) {
        alert("Password must contain letter, number, special char, and be 8+ chars.");
        valid = false;
      }
      return valid;
    }
  </script>
</head>
<body>
  <h2>SIGN UP</h2>
  <form name="signupForm" method="post" action="signup.php" onsubmit="return validateForm()">
    <label>Username</label><br>
    <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>">
    <div class="error"><?php echo $usernameErr; ?></div>

    <label>E-mail</label><br>
    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
    <div class="error"><?php echo $emailErr; ?></div>

    <label>Password</label><br>
    <input type="password" name="password">
    <div class="error"><?php echo $passwordErr; ?></div>

    <label><input type="checkbox" name="remember"> Remember me</label><br><br>

    <input type="submit" value="SIGN UP">
    <a href="#">Forgot password?</a>
  </form>
</body>
</html>
