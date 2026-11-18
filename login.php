<?php
session_start();
$error = $_SESSION["flash_error"] ?? "";
unset($_SESSION["flash_error"]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Nick Taggart, nick.taggart@nbcc.ca" />
    <title>Login - Y</title>
    <link href="includes/y.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="icon" href="favicon.ico">

</head>

<body class="login">
    <?php if ($error !== ""): ?>
        <span class="error-wrapper"><?= htmlspecialchars($error) ?></span>
    <?php endif; ?>
    <div class="login-card">
        <h1>Log in to&nbsp;<img alt="Y Logo" src="img/y_logo.png" class="loginlogo"></h1>

        <form action="proc/login_proc.php" method="POST">
            <div class="mb-3">
                <input type="text" name="username" class="form-control bg-black text-light" placeholder="Username" required />
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control bg-black text-light" placeholder="Password" required />
            </div>
            <button type="submit" class="btn-login w-100 text-light">Log In</button>
        </form>
        <div class="mb-3">
            Don't have an account? <a href="Signup.php">Click here to sign up</a> and bring back what you didn't miss.
        </div>
    </div>
</body>

</html>
