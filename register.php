<?php
session_start();
include 'connect.php'; 

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirm = trim($_POST["confirm_password"]);

    if ($password !== $confirm) {
        $error = "Passwords do not match!";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long!";
    } else {

        $check = mysqli_query($conn, "SELECT id FROM users WHERE username='$username' LIMIT 1");
        
        if (mysqli_num_rows($check) > 0) {
            $error = "Username is already taken!";
        } else {

            $hashed = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed')";
            
            if (mysqli_query($conn, $sql)) {
                $success = "Registration successful! Redirecting to login...";
                header("refresh:2; url=login.php");
            } else {
                $error = "Something went wrong. Please try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - ParkingCo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="login-styles.css">
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold text-primary" href="index.php">
            <img src="images/WEBLOGO.png" alt="Logo" height="80">
        </a>
    </div>
</nav>

<div class="main-container">
    <div class="login-container">
        <h1 class="login-title">Sign Up</h1>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="input-group">
                <label for="username">Username</label>
                <div class="input-wrapper">
                    <input type="text" name="username" placeholder="Enter a username" required>
                    <span class="input-icon">👤</span>
                </div>
            </div>

            <div class="input-group">
                <label for="email">Email</label>
                <div class="input-wrapper">
                    <input type="email" name="email" placeholder="Enter your email" required>
                    <span class="input-icon">📩</span>
                </div>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <input type="password" name="password" placeholder="Create a password" required>
                    <span class="input-icon">🔒</span>
                </div>
            </div>

            <div class="input-group">
                <label for="confirm_password">Confirm Password</label>
                <div class="input-wrapper">
                    <input type="password" name="confirm_password" placeholder="Confirm password" required>
                    <span class="input-icon">✅</span>
                </div>
            </div>

            <button type="submit" class="login-btn">REGISTER</button>
        </form>

        <button type="button" class="signup-btn" onclick="window.location.href='login.php'">BACK TO LOGIN</button>
    </div>
</div>

<script src="login-script.js"></script>
</body>
</html>
