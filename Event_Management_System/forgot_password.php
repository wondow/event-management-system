<?php
require 'includes/db.php';
require 'includes/mailer.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email_or_phone = $_POST['email'];
  $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->bind_param("ss", $email_or_phone, $email_or_phone);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    $otp = rand(100000, 999999);
    $expires_at = date('Y-m-d H:i:s', strtotime('+10 minutes'));

    $update = $conn->prepare("UPDATE users SET reset_otp = ?, otp_expires_at = ? WHERE id = ?");
    $update->bind_param("ssi", $otp, $expires_at, $user['id']);
    $update->execute();

    send_otp_email($user['email'], $otp); // Defined in mailer.php

    header("Location: verify_otp.php?user=" . $user['id']);
    exit;
  } else {
    $error = "No account found.";
  }
}
?>

<!-- Show form to enter email/phone -->

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Forgot Password - Evently</title>
  <link rel="stylesheet" href="includes/styles.css" />
</head>
<body>
  <div class="flex-container">
    <div class="intro-box">
      <h2>Password Help</h2>
      <p>
        Forgot your password? No worries! <br />
        Enter your email or phone number and we’ll help you reset it.
      </p>
    </div>

    <div class="form-container">
      <h2>Reset Your Password</h2>
      <form method="POST">
        <input type="text" name="email" placeholder="Email" required />
        <button type="submit">Send Reset Link</button>
      </form>

      <p>Remembered your password? <a href="index.php">Go back to login</a></p>
    </div>
  </div>
</body>
</html>
