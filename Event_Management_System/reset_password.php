<?php
require 'includes/db.php';

$user_id = $_GET['user'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
  $stmt = $conn->prepare("UPDATE users SET password = ?, reset_otp = NULL, otp_expires_at = NULL WHERE id = ?");
  $stmt->bind_param("si", $new_password, $user_id);
  $stmt->execute();

  $success = "Password updated successfully!";
}
?>

<!-- Form to enter new password -->
