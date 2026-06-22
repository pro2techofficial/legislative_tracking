<?php
require_once "../config.php";
$error = "";
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);
    $q = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password' AND status='Active'");
    if (mysqli_num_rows($q) === 1) {
        $u = mysqli_fetch_assoc($q);
        $_SESSION['user_id'] = $u['id'];
        $_SESSION['fullname'] = $u['fullname'];
        $_SESSION['role'] = $u['role'];
        log_action($conn, "Logged in", "Authentication");
        header("Location: ../dashboard.php");
        exit();
    } else {
        $error = "Invalid Username or Password";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>MLTS Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="login-page">
<div class="login-box">
    <div class="login-header">
        <img src="../assets/iguig.jpg" alt="Municipal Logo">
        <div class="login-title">
            <h1>MLTS</h1>
            <p>Municipal Legislative Tracking System</p>
        </div>
    </div>

    <?php if($error): ?><div class="error"><?= e($error) ?></div><?php endif; ?>

    <form method="POST">
        <label>Username</label>
        <input type="text" name="username" required autofocus>
        <label>Password</label>
        <input type="password" name="password" required>
        <button class="btn" name="login">Login</button>
    </form>
</div>
</body>
</html>
