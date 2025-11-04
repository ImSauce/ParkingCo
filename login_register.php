<?php include 'connect.php'; 
if (isset($_SESSION['user_name'])) {
  header("Location: index.php");
  exit();
}?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ParkingCo | Login & Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: url('images/parking.jpeg') center/cover no-repeat;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .overlay {
      background-color: rgba(0, 0, 0, 0.7);
      position: fixed;
      inset: 0;
      z-index: -1;
    }

    .form-container {
      margin-top: 120px;
      max-width: 420px;
      background: rgba(255, 255, 255, 0.9);
      border-radius: 15px;
      padding: 2.5rem;
      box-shadow: 0 4px 20px rgba(0,0,0,0.2);
    }

    .form-container h3 {
      color: #000;
      font-weight: 700;
      text-transform: uppercase;
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .form-control {
      border-radius: 10px;
    }

    .btn-primary {
      background-color: #0026ff;
      border: none;
      border-radius: 10px;
      font-weight: 600;
    }

    .btn-primary:hover {
      background-color: #001ccc;
    }

    .switch-link {
      color: #0026ff;
      font-weight: 600;
      text-decoration: none;
    }

    .switch-link:hover {
      text-decoration: underline;
    }

    footer {
      text-align: center;
      margin-top: auto;
      color: #bbb;
      padding: 20px 0;
    }
  </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-black">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold text-primary" href="index.php">
        <img src="images/WEBLOGO.png" alt="Logo" height="80">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="index.php#home">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="Aboutus.php">About</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php#slots">Slots</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php#contact">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="overlay"></div>

  <div class="container d-flex justify-content-center align-items-center flex-column">
    <div class="form-container" id="loginForm">
      <h3>Login</h3>
      <form action="login_process.php" method="POST">
        <div class="mb-3">
          <label for="email" class="form-label fw-semibold">Email</label>
          <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label fw-semibold">Password</label>
          <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>
        <p class="text-center text-dark">
          Don’t have an account?
          <a href="#" class="switch-link" id="showRegister">Register here</a>
        </p>
      </form>
    </div>

    <div class="form-container d-none" id="registerForm">
      <h3>Register</h3>
      <form action="register_process.php" method="POST">
        <div class="mb-3">
          <label for="fullname" class="form-label fw-semibold">Full Name</label>
          <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Enter your full name" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label fw-semibold">Email</label>
          <input type="email" name="email" id="reg_email" class="form-control" placeholder="Enter your email" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label fw-semibold">Password</label>
          <input type="password" name="password" id="reg_password" class="form-control" placeholder="Create a password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100 mb-3">Register</button>
        <p class="text-center text-dark">
          Already have an account?
          <a href="#" class="switch-link" id="showLogin">Login here</a>
        </p>
      </form>
    </div>
  </div>

  <footer>
    <p>© 2025 ParkingCo. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const showRegister = document.getElementById("showRegister");
    const showLogin = document.getElementById("showLogin");
    const loginForm = document.getElementById("loginForm");
    const registerForm = document.getElementById("registerForm");

    if (showRegister) {
      showRegister.addEventListener("click", e => {
        e.preventDefault();
        loginForm.classList.add("d-none");
        registerForm.classList.remove("d-none");
      });
    }

    if (showLogin) {
      showLogin.addEventListener("click", e => {
        e.preventDefault();
        registerForm.classList.add("d-none");
        loginForm.classList.remove("d-none");
      });
    }
  </script>
</body>
</html>
