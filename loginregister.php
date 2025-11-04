<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ParkingCo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg fixed-top navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold text-primary" href="index.php">
            <img src="images/WEBLOGO.png" alt="ParkingCo Logo" height="80">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="Aboutus.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#slots">Slots</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>

                <?php if (!isset($_SESSION['user_id'])): ?>
                    <!-- User NOT logged in -->
                    <li class="nav-item"><a class="nav-link text-primary" href="login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link text-primary" href="register.php">Sign Up</a></li>
                <?php else: ?>
                    <!-- User logged in -->
                    <li class="nav-item"><a class="nav-link text-success" href="#">Hi, <?= htmlspecialchars($_SESSION['username']); ?></a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Logout</a></li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>

<!-- HERO -->
<header id="home" class="hero-section">
    <div class="hero-content container">
        <h1 class="display-4 fw-bold text-primary">Reserve Your Parking Slots Easily</h1>
        <p class="lead mb-4">Book online, skip the stress, and enjoy a smooth parking experience.</p>

        <div>
            <?php if (!isset($_SESSION['user_id'])): ?>
                <a href="login.php" class="btn btn-primary btn-lg me-2">Log In</a>
                <a href="register.php" class="btn btn-outline-light btn-lg">Sign Up</a>
            <?php else: ?>
                <a href="index.php#reservation" class="btn btn-primary btn-lg me-2">Reserve Now</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<!-- FOOTER -->
<footer class="py-4 text-center">
    <div class="container">
        <p>&copy; 2025 ParkingCo. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="parking.js"></script>

</body>
</html>
