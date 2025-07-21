<?php
session_start();
require 'includes/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email_or_phone = $_POST['email_or_phone'] ?? '';
  $password = $_POST['password'] ?? '';
  $role = $_POST['role'] ?? '';

  if (empty($email_or_phone) || empty($password) || empty($role)) {
    $error = "All fields are required.";
  } else {
    $stmt = $conn->prepare("SELECT * FROM users WHERE (email = ? OR phone = ?) AND role = ?");
    $stmt->bind_param("sss", $email_or_phone, $email_or_phone, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
      $user = $result->fetch_assoc();
      if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['name'] = $user['name'];
        header("Location: " . ($role === 'admin' ? 'admin_dashboard.php' : 'user_dashboard.php'));
        exit;
      } else {
        $error = "Incorrect password.";
      }
    } else {
      $error = "No account found or role mismatch.";
    }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Evently Login</title>
  <link rel="stylesheet" href="includes/styles.css" />
</head>
<body>
  <div class="flex-container">
    <!-- Intro Section -->
    <div class="intro-box">
      <h2>Welcome Back!</h2>
      <p>
        Log in to manage your events, invite guests, track vendors, and more. <br />
        Whether you're planning your big day or running admin, you're in control.
      </p>
    </div>

    <!-- Form Section -->
    <div class="form-container">
      <h2>Log in to Your Account</h2>

      <?php if (!empty($error)): ?>
        <div class="error-box">
          <?php echo htmlspecialchars($error); ?>
        </div>
      <?php endif; ?>

      <form method="POST">
        <input type="text" name="email_or_phone" placeholder="Email or Phone" required />
        <input type="password" name="password" placeholder="Password" required />
        <p style="margin-top: 5px; margin-bottom: 15px; text-align: right;">
        <a href="forgot_password.php" style="color: #3498db; text-decoration: none;">Forgot Password?</a>
        </p>
        <select name="role" required>
          <option value="">Select Role</option>
          <option value="user">User</option>
          <option value="admin">Admin</option>
        </select>
        <button type="submit">Login</button>
      </form>

      <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
  </div>
</body>
</html>
