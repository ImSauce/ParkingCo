<?php
session_start();
include 'connect.php'; 

// If user submits login form
$login_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Find user
    $query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header("Location: index.php");
            exit();
        } else {
            $login_error = "Incorrect password.";
        }
    } else {
        $login_error = "Username not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ParkingCo - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="login-styles.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-black">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold text-primary" href="index.php"> 
            <img src="images/WEBLOGO.png" alt="ParkingCo Logo" height="80"> 
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link active" href="index.php#home">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="Aboutus.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php#reservation">Slots</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php#contact">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Container -->
<div class="main-container">
    <div class="login-container">
        <h1 class="login-title">Login</h1>

        <?php if (!empty($login_error)): ?>
        <div class="alert alert-danger py-2"><?= $login_error ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="input-group">
                <label for="username">Username</label>
                <div class="input-wrapper">
                    <input type="text" name="username" id="username" placeholder="Type your username" required>
                    <span class="input-icon">👤</span>
                </div>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <input type="password" name="password" id="password" placeholder="Type your password" required>
                    <span class="input-icon">🔒</span>
                </div>
            </div>

            <div class="forgot-password">
                <a href="#">Forgot password?</a>
            </div>

            <button type="submit" class="login-btn">LOGIN</button>
        </form>

        <button type="button" class="signup-btn" onclick="window.location.href='register.php'">SIGN UP</button>
    </div>
</div>

<script src="login-script.js"></script>
</body>
</html>
