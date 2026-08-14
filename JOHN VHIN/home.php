PHP
<?php session_start();
 
    if ($_SESSION['fname'] == "JV") {
 
    ?>
 
<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@500;600&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
</head>
 
<body>
    <main class="home-wrap">
        <div class="home-card">
            <p class="eyebrow">// session active</p>
            <h1>Welcome back</h1>
            <p class="name">
                <?php echo htmlspecialchars($_SESSION['fname'] . ' ' . $_SESSION['lname']); ?>
            </p>
            <a class="logout-link" href="logout.php">Log out</a>
        </div>
    </main>
</body>
 
</html>
 
<?php } else {
 
    echo "You dont have permission to access this!";
 
}?>