<?php
session_start();

// Check if already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin-dashboard.php");
    exit();
}

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'connect.php';
    
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    
    // Query admin table
    $sql = "SELECT * FROM admins WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $admin = mysqli_fetch_assoc($result);
        
        // Verify password
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            $_SESSION['admin_name'] = $admin['full_name'];
            
            echo "<script>alert('Login successful! Welcome, Admin.'); window.location='admin-dashboard.php';</script>";
            exit();
        } else {
            $error = "Invalid username or password";
        }
    } else {
        $error = "Invalid username or password";
    }
    
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login - ParkingCo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="login-styles.css">
  <style>
    .admin-badge {
      position: absolute;
      top: -15px;
      right: -15px;
      background: linear-gradient(135deg, #dc3545, #c82333);
      color: white;
      padding: 8px 15px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: bold;
      box-shadow: 0 4px 15px rgba(220, 53, 69, 0.4);
      animation: pulse-badge 2s ease-in-out infinite;
    }
    
    @keyframes pulse-badge {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.05); }
    }
    
    .login-title {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
    }
    
    .login-title i {
      color: #dc3545;
    }
    
    .error-message {
      background: rgba(220, 53, 69, 0.2);
      border: 1px solid #dc3545;
      color: #ff6b6b;
      padding: 12px;
      border-radius: 8px;
      margin-bottom: 20px;
      text-align: center;
      font-size: 14px;
    }
  </style>
</head>
<body>  
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold text-primary" href="index.html"> 
        <img src="images/WEBLOGO.png" alt="ParkingCo Logo" height="80"> 
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="Aboutus.html">About</a></li>
          <li class="nav-item"><a class="nav-link" href="LogIn.html">User Login</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Container -->
  <div class="main-container">
    <div class="login-container" style="position: relative;">
      <span class="admin-badge">
        <i class="fas fa-shield-alt"></i> ADMIN ACCESS
      </span>
      
      <h1 class="login-title">
        <i class="fas fa-user-shield"></i>
        Admin Login
      </h1>
      
      <?php if (isset($error)): ?>
        <div class="error-message">
          <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
        </div>
      <?php endif; ?>
      
      <form method="POST" action="">
        <div class="input-group">
          <label for="username">Username</label>
          <div class="input-wrapper">
            <input type="text" id="username" name="username" placeholder="Admin username" required>
            <span class="input-icon">👤</span>
          </div>
        </div>

        <div class="input-group">
          <label for="password">Password</label>
          <div class="input-wrapper">
            <input type="password" id="password" name="password" placeholder="Admin password" required>
            <span class="input-icon">🔒</span>
          </div>
        </div>

        <button type="submit" class="login-btn" style="background: linear-gradient(90deg, #dc3545, #c82333);">
          <i class="fas fa-sign-in-alt"></i> ADMIN LOGIN
        </button>
      </form>

      <div class="text-center mt-3">
        <a href="LogIn.html" class="text-muted" style="font-size: 13px; text-decoration: none;">
          <i class="fas fa-arrow-left"></i> Back to User Login
        </a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>