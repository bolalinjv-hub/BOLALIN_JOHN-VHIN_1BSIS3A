<!doctype html>
<html lang="en">
 
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Member Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@500;600&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>
 
<body>
    <main class="wrap">
        <div class="card">
            <p class="eyebrow">WELCOME!</p>
            <h1>Sign in</h1>
            <p class="sub">Enter your credentials to continue.</p>
 
            <form action="check.php" method="post">
                <label class="field">
                    <span class="field-label">Username</span>
                    <input type="text" name="username" placeholder="Enter username" required />
                </label>
 
                <label class="field">
                    <span class="field-label">Password</span>
                    <div class="password-wrapper">
                        <input id="pwd" name="password" type="password" placeholder="Enter password" required />
                        <i id="eye" class="bi bi-eye-fill"></i>
                    </div>
                </label>
 
                <button name="submit" type="submit">Log in</button>
            </form>
        </div>
    </main>
 
    <script src="script.js"></script>
</body>
 
</html>

</html>
