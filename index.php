<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portal Access | Student SIS</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="auth-page">

  <div class="auth-card">
    <div class="auth-header">
      <div class="auth-icon">🎓</div>
      <h1>Academy Portal</h1>
      <p>Student Record & Registry System</p>
    </div>

    <?php if (isset($_GET['failed'])): ?>
      <div class="alert alert-error">Invalid access credentials provided.</div>
    <?php endif; ?>

    <form action="auth.php" method="POST">
      <div class="form-group">
        <label for="username">Username ID</label>
        <input type="text" id="username" name="username" placeholder="e.g. jv" required autocomplete="off">
      </div>

      <div class="form-group">
        <label for="password">Account Password</label>
        <input type="password" id="password" name="password" placeholder="••••••••" required>
      </div>

      <button type="submit" class="btn-primary">Sign In to Dashboard</button>
    </form>
  </div>

</body>
</html>