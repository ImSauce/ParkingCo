<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ParkingCo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
/* === Force all Schedule Form text to black === */
.schedule-form,
.schedule-form * {
  color: #000 !important;
}

/* Make the background of the form solid white for visibility */
.schedule-form {
  background-color: #fff !important;
  border-radius: 12px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
  padding: 2rem;
}

/* Fix for the "SCHEDULE FORM" title */
.schedule-form h5,
.schedule-form h4,
.schedule-form h3 {
  color: #000 !important;
  font-weight: bold;
  text-transform: uppercase;
}

/* Inputs and placeholders */
.schedule-form input,
.schedule-form select,
.schedule-form textarea {
  color: #000 !important;
  background-color: #fff !important;
  border: 1px solid #ccc;
}

.schedule-form input::placeholder {
  color: #760cccff !important;
}

/* Optional: Fix gray total labels (subtotal, discount, total) */
.schedule-form .text-muted,
.schedule-form .total-label {
  color: #000 !important;
  font-weight: 600;
}

/* Smooth scrolling */
html {
  scroll-behavior: smooth;
}
</style>
</head>
<body>
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-black">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold text-primary" href="#"> 
        <img src="images/WEBLOGO.png" alt="Okada Logo" height="80"> 
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav ms-auto">
  <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
  <li class="nav-item"><a class="nav-link" href="Aboutus.php">About</a></li>
  <li class="nav-item"><a class="nav-link" href="#slots">Slots</a></li>
  <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>

  <?php if (isset($_SESSION['user_name'])): ?>
    <li class="nav-item">
      <a class="nav-link text-primary fw-bold" href="#">
        Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>
      </a>
    </li>
    <li class="nav-item">
      <a class="btn btn-outline-light ms-2" href="logout.php">Logout</a>
    </li>
  <?php else: ?>
    <li class="nav-item">
      <a class="btn btn-primary ms-2" href="login_register.php">Login / Register</a>
    </li>
  <?php endif; ?>
</ul>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <header id="home" class="hero-section">
    <div class="hero-content container text-center text-light py-5">
      <h1 class="display-4 fw-bold text-primary">Reserve Your Parking Slots Easily</h1>
      <p class="lead mb-4">Book online, skip the stress, and enjoy a smooth parking experience.</p>
      <div>
        <!-- FIXED BUTTON -->
        <button id="reserveBtn" class="btn btn-primary btn-lg me-2" onclick="scrollToForm()">Reserve Now</button>
        <button id="readMoreBtn" class="btn btn-outline-light btn-lg" onclick="scrollToAbout()">Learn More</button>
      </div>
    </div>
  </header>

  <!-- ABOUT -->
  <section id="about" class="py-5 text-center">
    <div class="container">
      <h2 class="fw-bold mb-3">About ParkingCo</h2>
      <p class="text-muted">
        ParkingCo is a modern reservation system designed to make parking more convenient. 
        With just a few clicks, drivers can secure their spots ahead of time, 
        avoid last-minute stress, and get real-time updates on slot availability.
      </p>
    </div>
  </section>

  <!-- SLOTS -->
  <section id="slots" class="py-5 alt-bg">
    <div class="container text-center">
      <h2 class="fw-bold mb-4">Available Slots</h2>
      <p class="mb-5">Check parking availability below. Updated in real-time 🚗</p>

      <div class="row g-4">
        <?php
          $slots = ['A1','A2','A3','A4','A5','B1','B2','B3','B4','B5','C1','C2','C3','C4','C5'];

          foreach ($slots as $slot) {
            $sql = "SELECT * FROM reservations WHERE slot='$slot' AND end_date >= CURDATE()";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
              $status = "Booked";
              $statusClass = "booked";
            } else {
              $status = "Available";
              $statusClass = "available";
            }

            echo "
              <div class='col-md-3'>
                <div class='slot-card'>
                  <h3>Slot $slot</h3>
                  <p>Status: <span class='status $statusClass'>$status</span></p>
                </div>
              </div>
            ";
          }
        ?>
      </div>
    </div>
  </section>

  <!-- SCHEDULE FORM -->
  <section id="reservation" class="slots-section">
    <div class="slots-container container py-5">
      <div class="schedule-form p-4 rounded bg-light">
        <h5 class="text-center mb-3">SCHEDULE FORM</h5>
        <form action="reserve.php" method="POST">
          <div class="row g-3">
            <div class="col-md-6">
              <label>Full Name</label>
              <input type="text" name="fullname" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label>Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label>Select Slot</label>
              <select name="slot" class="form-select" required>
                <?php
                  foreach ($slots as $slot) {
                    echo "<option value='$slot'>$slot</option>";
                  }
                ?>
              </select>
            </div>
            <div class="col-md-6">
              <label>Enter Start Date</label>
              <input type="date" name="start_date" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label>Enter Start Time</label>
              <input type="time" name="start_time" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label>Enter End Date</label>
              <input type="date" name="end_date" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label>Enter End Time</label>
              <input type="time" name="end_time" class="form-control" required>
            </div>
            <div class="col-12">
              <label>Enter Promo Code (Optional)</label>
              <input type="text" name="promo_code" class="form-control">
            </div>
            <div class="col-12">
              <label>Total</label>
              <input type="number" step="0.01" name="total" class="form-control" required>
            </div>
          </div>

          <div class="text-end mt-3">
            <p>Subtotal: ₱<span id="subtotal">0.00</span></p>
            <p>Discount: ₱<span id="discount">0.00</span></p>
            <p><strong>Total: ₱<span id="total">0.00</span></strong></p>
          </div>

          <button type="submit" class="btn btn-primary w-100 mt-2">PROCEED PAYMENT</button>
          <a href="view_reservations.php" class="btn btn-outline-dark w-100 mt-2 reservation-btn">View Reservations</a>
        </form>
      </div>
    </div>
  </section>

  <!-- CONTACT -->
  <section id="contact" class="py-5" style="background-color: #333; color: white;">
    <div class="container text-center">
      <h2 class="text-primary mb-4 fw-bold">Contact Us!</h2>

      <div class="row justify-content-center align-items-center">
        <div class="col-md-5">
          <div class="p-4 rounded" style="background-color: #1c1c1c;">
            <p>Email: <a href="mailto:support@parkingco.com" class="text-info">support@parkingco.com</a></p>
            <p>Phone: <a href="tel:+639000000000" class="text-info">+63 900 000 0000</a></p>
            <p>938 Aurora Blvd, Cubao, Quezon City, 1109 Metro Manila</p>
          </div>
        </div>

        <div class="col-md-5">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3858.204684702614!2d121.05533277590667!3d14.62351097633994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b7b6dcde71f1%3A0x2a2b9f6c9a12ebf5!2sSM%20Hypermarket%20Cubao!5e0!3m2!1sen!2sph!4v1700000000000!5m2!1sen!2sph"
            width="100%" height="250" style="border:0; border-radius: 10px;" allowfullscreen="" loading="lazy">
          </iframe>
        </div>
      </div>
    </div>

    <footer class="mt-5 text-center" style="color: #ccc;">
      <p>© 2025 ParkingCo. All rights reserved.</p>
    </footer>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- JS Scroll -->
  <script>
  function scrollToForm() {
    document.querySelector('#reservation').scrollIntoView({ behavior: 'smooth' });
  }

  function scrollToAbout() {
    document.querySelector('#about').scrollIntoView({ behavior: 'smooth' });
  }
  </script>

  <script src="parking.js"></script>
</body>
</html>
