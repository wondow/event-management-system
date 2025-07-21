<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'includes/db.php';

$user_id = $_GET['user'] ?? null;

if (!$user_id) {
  die("Missing user ID.");
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $otp = $_POST['otp'] ?? '';
  $stmt = $conn->prepare("SELECT * FROM users WHERE id = ? AND reset_otp = ? AND otp_expires_at > NOW()");
  $stmt->bind_param("is", $user_id, $otp);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    header("Location: reset_password.php?user=$user_id");
    exit;
  } else {
    $error = "Invalid or expired OTP.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Verify OTP</title>
  <link rel="stylesheet" href="includes/styles.css">
</head>
<body>
  <div class="form-container" style="margin: 100px auto; max-width: 400px;">
    <h2>Enter OTP</h2>
    <?php if (!empty($error)): ?>
      <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST">
      <input type="text" name="otp" placeholder="Enter OTP" required />
      <button type="submit">Verify</button>
    </form>
  </div>
</body>
</html>
