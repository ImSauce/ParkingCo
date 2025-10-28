<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - ParkingCo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet">
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
          <li class="nav-item"><a class="nav-link" href="index.php#home">Home</a></li>
          <li class="nav-item"><a class="nav-link active" href="Aboutus.php">About</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php#slots">Slots</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php#contact">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- ABOUT SECTION -->
  <section class="about-page">
    <div class="container-fluid d-flex align-items-center min-vh-100">
      <div class="row w-100 ps-5">
        <div class="col-md-6">
          <div class="about-box mb-4">
            <h2 class="text-primary fw-bold">ABOUT US</h2>
            <p>
              ParkingCo was created to solve a common problem in urban locations: the difficulty many drivers experience trying to find parking.
              That inefficient search for a paid parking spot is frustrating, and also contributes to a lack of flow and congestion.
            </p>
          </div>
          <div class="about-box">
            <h3 class="text-primary fw-bold">Group Members</h3>
            <ul class="list-unstyled mt-3">
              <li>YU, MIURA</li>
              <li>CINCO, SAMUEL JAMES A.</li>
              <li>MACAWILE, STEVEN LORENZ Y.</li>
              <li>BAUTISTA, CLIFF JEFFERSON S.</li>
              <li>AYUBAN, JENINA GAIL B.</li>
            </ul>
          </div>
        </div>

        <!-- Logo or Graphic -->
        <div class="col-md-6 d-flex justify-content-center align-items-center">
          <img src="images/WEBLOGO.png" alt="ParkingCo Logo" class="img-fluid about-logo">
        </div>
      </div>
    </div>
  </section>

  <footer class="py-3 text-center bg-black text-light">
    <div class="container">
      <p>&copy; 2025 ParkingCo. All rights reserved.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
