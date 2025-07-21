<?php
require_once 'includes/db.php';

$name = $email = $phone = $password = $confirm_password = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if (empty($name) || empty($email) || empty($phone) || empty($password) || empty($confirm_password)) {
        $errors[] = "All fields are required.";
    } elseif ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    } else {
        // Check if email or phone already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? OR phone = ?");
        $stmt->bind_param("ss", $email, $phone);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors[] = "Email or phone already exists.";
        } else {
            // Insert user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (name, email, phone, password, role) VALUES (?, ?, ?, ?, 'user')");
            $stmt->bind_param("ssss", $name, $email, $phone, $hashed_password);
            if ($stmt->execute()) {
                header("Location: index.php?success=registered");
                exit();
            } else {
                $errors[] = "Registration failed.";
            }
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <link rel="stylesheet" href="includes/styles.css">
</head>
<body>
  <div class="flex-container">
    <!-- Intro Section -->
    <div class="intro-box">
      <h2>Welcome to Evently</h2>
      <p>
        Plan events with ease and precision. <br />
        From weddings to corporate meetings, manage guests, vendors, scheduling, and billing — all in one place.
      </p>
    </div>

    <!-- Form Section -->
    <div class="form-container">
      <h2>Create Your Account</h2>
      <?php if (!empty($errors)): ?>
        <div class="error-box">
          <ul>
            <?php foreach ($errors as $error): ?>
              <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <form method="POST">
        <input type="text" name="name" placeholder="Full Name" value="<?php echo htmlspecialchars($name); ?>" required>
        <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" required>
        <input type="text" name="phone" placeholder="Phone Number" value="<?php echo htmlspecialchars($phone); ?>" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit">Register</button>
      </form>

      <p>Already have an account? <a href="index.php">Login here</a></p>
    </div>
  </div>
</body>

</html>
