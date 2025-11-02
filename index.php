<<<<<<< Updated upstream
<<<<<<< Updated upstream
<?php include 'connect.php'; ?>
=======
=======
>>>>>>> Stashed changes
<?php
// This is a placeholder for any future server-side logic (e.g., fetching real-time data or managing sessions).
// For now, the file primarily serves the HTML/CSS/JS content.

// If you were to connect to a database or fetch dynamic data, 
// the PHP code would go here before the HTML output starts, and 
// echo or print statements would be used within the HTML sections.

/* Example PHP logic for dynamic content:
// $page_title = "ParkingCo - Home";
// $locations = fetch_parking_locations(); 
*/
?>
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
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
=======
    .reservation-btn {
      border: 2px solid #0d6efd;
      color: #0d6efd;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    .reservation-btn:hover {
      background-color: #0d6efd;
      color: white;
      transform: scale(1.03);
    }

    /* Floor Details Modal Styles */
    .floor-details-section {
      margin-top: 20px;
      padding: 20px;
      background: rgba(255, 255, 255, 0.05);
      border: 2px solid rgba(46, 91, 227, 0.4);
      border-radius: 12px;
      display: none;
    }

    .floor-details-section.active {
      display: block;
      animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .floor-item {
      background: rgba(0, 0, 0, 0.3);
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border: 1px solid rgba(255, 255, 255, 0.1);
      transition: all 0.3s ease;
    }

    .floor-item:hover {
      background: rgba(46, 91, 227, 0.2);
      border-color: rgba(46, 91, 227, 0.5);
      transform: translateX(5px);
    }

    .floor-name {
      font-weight: 600;
      font-size: 16px;
      color: #fff;
    }

    .floor-capacity {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .capacity-text {
      font-size: 14px;
      color: #ccc;
    }

    .floor-status {
      padding: 5px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      text-transform: uppercase;
    }

    .floor-status.available {
      background: linear-gradient(135deg, #d1e7dd, #a3cfbb);
      color: #0f5132;
    }

    .floor-status.limited {
      background: linear-gradient(135deg, #fff3cd, #ffd966);
      color: #856404;
    }

    .floor-status.full {
      background: linear-gradient(135deg, #f8d7da, #f1aeb5);
      color: #842029;
    }

    .progress-bar-custom {
      width: 100px;
      height: 8px;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 10px;
      overflow: hidden;
    }

    .progress-fill {
      height: 100%;
      background: linear-gradient(90deg, #4ade80, #22c55e);
      border-radius: 10px;
      transition: width 0.3s ease;
    }

    .progress-fill.limited {
      background: linear-gradient(90deg, #fbbf24, #f59e0b);
    }

    .progress-fill.full {
      background: linear-gradient(90deg, #ef4444, #dc2626);
    }

    .location-floors-badge {
      position: absolute;
      top: 10px;
      right: 10px;
      background: linear-gradient(135deg, #7622c4, #2e5be3);
      color: #fff;
      padding: 5px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      z-index: 2;
    }

    .select-location-btn {
      width: 100%;
      margin-top: 15px;
      padding: 10px;
      background: linear-gradient(90deg, #7622c4, #2e5be3);
      border: none;
      color: white;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .select-location-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 20px rgba(46, 91, 227, 0.5);
    }

    .selected-location-indicator {
      position: absolute;
      top: 10px;
      left: 10px;
      background: #22c55e;
      color: white;
      padding: 5px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      z-index: 2;
      display: none;
    }

    .selected-location-indicator.active {
      display: block;
    }
  </style>
</head>
<body>
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
>>>>>>> Stashed changes
    <div class="container-fluid">
      <a class="navbar-brand fw-bold text-primary" href="#"> 
        <img src="images/WEBLOGO.png" alt="Okada Logo" height="80"> 
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
<<<<<<< Updated upstream
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
=======
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link active nav-link-expand" href="#home">Home</a></li>
          <li class="nav-item">
            <a class="nav-link nav-link-expand" href="Aboutus.php" onclick="window.location.href='Aboutus.php'; return false;">About</a>
          </li>
          <li class="nav-item"><a class="nav-link nav-link-expand" href="#reservation">Reserve</a></li>
          <li class="nav-item"><a class="nav-link nav-link-expand" href="#contact">Contact</a></li>
        </ul>
>>>>>>> Stashed changes
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <header id="home" class="hero-section">
<<<<<<< Updated upstream
    <div class="hero-content container text-center text-light py-5">
      <h1 class="display-4 fw-bold text-primary">Reserve Your Parking Slots Easily</h1>
      <p class="lead mb-4">Book online, skip the stress, and enjoy a smooth parking experience.</p>
      <div>
        <!-- FIXED BUTTON -->
        <button id="reserveBtn" class="btn btn-primary btn-lg me-2" onclick="scrollToForm()">Reserve Now</button>
        <button id="readMoreBtn" class="btn btn-outline-light btn-lg" onclick="scrollToAbout()">Learn More</button>
=======
    <div class="hero-content container">
      <h1 class="display-4 fw-bold text-primary">Reserve Your Parking Slots Easily</h1>
      <p class="lead mb-4">Book online, skip the stress, and enjoy a smooth parking experience.</p>
      <div>
        <a href="#reservation" class="btn btn-primary btn-lg me-2">Reserve Now</a>
        <a href="#about" class="btn btn-outline-light btn-lg">Learn More</a>
>>>>>>> Stashed changes
      </div>
    </div>
  </header>

  <!-- ABOUT -->
<<<<<<< Updated upstream
  <section id="about" class="py-5 text-center">
    <div class="container">
=======
  <section id="about" class="py-5">
    <div class="container text-center">
>>>>>>> Stashed changes
      <h2 class="fw-bold mb-3">About ParkingCo</h2>
      <p class="text-muted">
        ParkingCo is a modern reservation system designed to make parking more convenient. 
        With just a few clicks, drivers can secure their spots ahead of time, 
<<<<<<< Updated upstream
        avoid last-minute stress, and get real-time updates on slot availability.
=======
        avoid last-minute stress, and get real-time updates on slot availability across multiple locations and floors.
>>>>>>> Stashed changes
      </p>
    </div>
  </section>

<<<<<<< Updated upstream
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
=======
  <!-- SCHEDULE FORM -->
  <section id="reservation" class="slots-section">
    <div class="slots-container">
      <!-- LEFT: Schedule Form -->
      <div class="schedule-form p-4 rounded">
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
              <label>Select Slot</label>
              <select name="slot" class="form-select" required>
                <?php
                  foreach ($slots as $slot) {
                    echo "<option value='$slot'>$slot</option>";
                  }
                ?>
=======
              <label>Selected Location</label>
              <input type="text" id="selectedLocationInput" name="location" class="form-control" readonly required>
            </div>
            <div class="col-md-6">
              <label>Select Floor</label>
              <select id="floorSelect" name="floor" class="form-select" required disabled>
                <option value="">Choose location first</option>
>>>>>>> Stashed changes
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

<<<<<<< Updated upstream
=======
          <!-- Display subtotal/discount/total -->
>>>>>>> Stashed changes
          <div class="text-end mt-3">
            <p>Subtotal: ₱<span id="subtotal">0.00</span></p>
            <p>Discount: ₱<span id="discount">0.00</span></p>
            <p><strong>Total: ₱<span id="total">0.00</span></strong></p>
          </div>

          <button type="submit" class="btn btn-primary w-100 mt-2">PROCEED PAYMENT</button>
<<<<<<< Updated upstream
          <a href="view_reservations.php" class="btn btn-outline-dark w-100 mt-2 reservation-btn">View Reservations</a>
        </form>
      </div>
=======
          <a href="view_reservations.php" class="btn btn-outline-light w-100 mt-2 reservation-btn">View Reservations</a>
        </form>
      </div>

      <!-- RIGHT: Choose Location with Swiper -->
      <div class="choose-location p-4 rounded text-center">
        <h5 class="mb-3">CHOOSE LOCATION</h5>
        
        <!-- Location Slider Container -->
        <div class="location-slider-wrapper">
          <div class="location-slider" id="locationSlider">
            <!-- Location 1: Quezon City (3 Floors) -->
            <div class="location-slide active" data-location="Quezon City" data-floors="3" data-rate="5">
              <div class="location-card-new">
                <span class="selected-location-indicator" id="selected-qc">✓ Selected</span>
                <span class="location-floors-badge">3 Floors</span>
                <div class="location-icon-wrapper">
                  <i class="fas fa-car fa-4x"></i>
                </div>
                <h4 class="location-name">QUEZON CITY PARKING LOT</h4>
                <div class="location-details">
                  <p class="location-address"><i class="fas fa-map-marker-alt"></i> 938 Aurora Blvd, Cubao</p>
                  <p class="location-price">₱5 PER HOUR</p>
                  <div class="location-features">
                    <span><i class="fas fa-shield-alt"></i> 24/7 Security</span>
                    <span><i class="fas fa-camera"></i> CCTV</span>
                  </div>
                </div>
                <button class="select-location-btn" onclick="selectLocation('Quezon City', 3, 5, 'qc')">Select Location</button>
              </div>
            </div>

            <!-- Location 2: Makati (2 Floors) -->
            <div class="location-slide" data-location="Makati" data-floors="2" data-rate="8">
              <div class="location-card-new">
                <span class="selected-location-indicator" id="selected-makati">✓ Selected</span>
                <span class="location-floors-badge">2 Floors</span>
                <div class="location-icon-wrapper">
                  <i class="fas fa-building fa-4x"></i>
                </div>
                <h4 class="location-name">MAKATI BUSINESS DISTRICT</h4>
                <div class="location-details">
                  <p class="location-address"><i class="fas fa-map-marker-alt"></i> Ayala Avenue, Makati City</p>
                  <p class="location-price">₱8 PER HOUR</p>
                  <div class="location-features">
                    <span><i class="fas fa-wifi"></i> Free WiFi</span>
                    <span><i class="fas fa-charging-station"></i> EV Charging</span>
                  </div>
                </div>
                <button class="select-location-btn" onclick="selectLocation('Makati', 2, 8, 'makati')">Select Location</button>
              </div>
            </div>

            <!-- Location 3: BGC (1 Floor) -->
            <div class="location-slide" data-location="BGC" data-floors="1" data-rate="10">
              <div class="location-card-new">
                <span class="selected-location-indicator" id="selected-bgc">✓ Selected</span>
                <span class="location-floors-badge">1 Floor</span>
                <div class="location-icon-wrapper">
                  <i class="fas fa-city fa-4x"></i>
                </div>
                <h4 class="location-name">BGC CENTRAL PLAZA</h4>
                <div class="location-details">
                  <p class="location-address"><i class="fas fa-map-marker-alt"></i> 5th Avenue, BGC, Taguig</p>
                  <p class="location-price">₱10 PER HOUR</p>
                  <div class="location-features">
                    <span><i class="fas fa-umbrella"></i> Covered</span>
                    <span><i class="fas fa-concierge-bell"></i> Valet Service</span>
                  </div>
                </div>
                <button class="select-location-btn" onclick="selectLocation('BGC', 1, 10, 'bgc')">Select Location</button>
              </div>
            </div>
          </div>

          <!-- Navigation Dots -->
          <div class="slider-dots">
            <span class="dot active" data-slide="0"></span>
            <span class="dot" data-slide="1"></span>
            <span class="dot" data-slide="2"></span>
          </div>

          <!-- Swipe Indicator -->
          <div class="swipe-indicator">
            <i class="fas fa-hand-point-left"></i> Swipe or Click Dots
          </div>
        </div>

        <!-- Floor Details Section -->
        <div class="floor-details-section" id="floorDetails">
          <h6 class="text-white mb-3"><i class="fas fa-layer-group"></i> Available Floors</h6>
          <div id="floorList"></div>
        </div>

        <button class="btn btn-outline-light w-100 mt-3">VIEW MAP</button>
      </div>
>>>>>>> Stashed changes
    </div>
  </section>

  <!-- CONTACT -->
<<<<<<< Updated upstream
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
=======
  <section id="contact" class="py-5">
    <div class="container">
      <h2 class="fw-bold mb-4 text-center text-primary">Get In Touch</h2>
      <p class="text-center text-muted mb-5">Have questions? We're here to help you find the perfect parking solution.</p>
      
      <div class="row g-4 mb-5">
        <!-- Contact Info Cards -->
        <div class="col-md-4">
          <div class="contact-info-card text-center p-4 h-100">
            <div class="contact-icon mb-3">
              <i class="fas fa-envelope fa-3x text-primary"></i>
            </div>
            <h5 class="fw-bold">Email Us</h5>
            <p class="text-muted mb-0">
              <a href="mailto:support@parkingco.com" class="text-decoration-none">support@parkingco.com</a><br>
              <a href="mailto:info@parkingco.com" class="text-decoration-none">info@parkingco.com</a>
            </p>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="contact-info-card text-center p-4 h-100">
            <div class="contact-icon mb-3">
              <i class="fas fa-phone fa-3x text-primary"></i>
            </div>
            <h5 class="fw-bold">Call Us</h5>
            <p class="text-muted mb-0">
              <a href="tel:+639000000000" class="text-decoration-none">+63 900 000 0000</a><br>
              <a href="tel:+639111111111" class="text-decoration-none">+63 911 111 1111</a>
            </p>
            <small class="text-muted d-block mt-2">Mon-Fri: 8AM-8PM</small>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="contact-info-card text-center p-4 h-100">
            <div class="contact-icon mb-3">
              <i class="fas fa-map-marker-alt fa-3x text-primary"></i>
            </div>
            <h5 class="fw-bold">Visit Us</h5>
            <p class="text-muted mb-0">
              938 Aurora Blvd, Cubao<br>
              Quezon City, 1109<br>
              Metro Manila, Philippines
            </p>
          </div>
        </div>
      </div>

      <!-- Map Section -->
      <div class="row">
        <div class="col-12">
          <div class="map-wrapper rounded overflow-hidden shadow">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3860.857474285885!2d121.04594407579348!3d14.612988677601155!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b62d33f814eb%3A0xa6c2583cce9701ef!2sTechnological%20Institute%20of%20the%20Philippines!5e0!3m2!1sen!2sph!4v1695732457283!5m2!1sen!2sph" 
              width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="footer-section">
    <div class="container py-5">
      <div class="row g-4">
        <!-- Company Info -->
        <div class="col-lg-4 col-md-6">
          <div class="footer-widget">
            <img src="images/WEBLOGO.png" alt="ParkingCo Logo" height="60" class="mb-3">
            <p class="text-muted">
              Making parking hassle-free with smart reservation technology. 
              Book your spot in seconds and drive with confidence.
            </p>
            <div class="social-links mt-3">
              <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
              <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
              <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
              <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
            </div>
          </div>
        </div>

        <!-- Quick Links -->
        <div class="col-lg-2 col-md-6">
          <div class="footer-widget">
            <h5 class="footer-title">Quick Links</h5>
            <ul class="footer-links">
              <li><a href="#home">Home</a></li>
              <li><a href="Aboutus.html">About Us</a></li>
              <li><a href="#reservation">Book Now</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </div>
        </div>

        <!-- Services -->
        <div class="col-lg-3 col-md-6">
          <div class="footer-widget">
            <h5 class="footer-title">Our Services</h5>
            <ul class="footer-links">
              <li><a href="#">Hourly Parking</a></li>
              <li><a href="#">Daily Parking</a></li>
              <li><a href="#">Monthly Passes</a></li>
              <li><a href="#">Corporate Solutions</a></li>
              <li><a href="#">Event Parking</a></li>
            </ul>
          </div>
        </div>

        <!-- Newsletter -->
        <div class="col-lg-3 col-md-6">
          <div class="footer-widget">
            <h5 class="footer-title">Stay Updated</h5>
            <p class="text-muted mb-3">Subscribe to get special offers and parking tips!</p>
            <form class="newsletter-form">
              <div class="input-group">
                <input type="email" class="form-control" placeholder="Your email" required>
                <button class="btn btn-primary" type="submit">
                  <i class="fas fa-paper-plane"></i>
                </button>
              </div>
            </form>
            <div class="payment-methods mt-4">
              <small class="text-muted d-block mb-2">We Accept:</small>
              <i class="fab fa-cc-visa fa-2x me-2"></i>
              <i class="fab fa-cc-mastercard fa-2x me-2"></i>
              <i class="fab fa-cc-paypal fa-2x"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer Bottom -->
      <div class="footer-bottom mt-4 pt-4 border-top border-secondary">
        <div class="row align-items-center">
          <div class="col-md-6 text-center text-md-start">
            <p class="mb-0 text-muted">
              &copy; 2025 ParkingCo. All rights reserved.
            </p>
          </div>
          <div class="col-md-6 text-center text-md-end">
            <ul class="footer-bottom-links">
              <li><a href="#">Privacy Policy</a></li>
              <li><a href="#">Terms of Service</a></li>
              <li><a href="#">FAQ</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- SCRIPTS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Floor Data -->
  <script>
// Simulated floor occupancy data (in real app, fetch from database)
const floorData = {
  'Quezon City': [
    { floor: 'Floor 1', occupied: 45, capacity: 100 },
    { floor: 'Floor 2', occupied: 78, capacity: 100 },
    { floor: 'Floor 3', occupied: 100, capacity: 100 }
  ],
  'Makati': [
    { floor: 'Floor 1', occupied: 92, capacity: 100 },
    { floor: 'Floor 2', occupied: 35, capacity: 100 }
  ],
  'BGC': [
    { floor: 'Floor 1', occupied: 67, capacity: 100 }
  ]
};

let currentRate = 5;
let selectedLocationName = '';

// Get all necessary elements once (outside of functions for performance)
const selectedLocationInput = document.getElementById('selectedLocationInput');
const floorDetailsSection = document.getElementById('floorDetails');
const floorList = document.getElementById('floorList');
const floorSelect = document.getElementById('floorSelect');
const startDate = document.querySelector('input[name="start_date"]');
const startTime = document.querySelector('input[name="start_time"]');
const endDate = document.querySelector('input[name="end_date"]');
const endTime = document.querySelector('input[name="end_time"]');
const promoInput = document.querySelector('input[name="promo_code"]');
const totalInput = document.querySelector('input[name="total"]');
const subtotalDisplay = document.getElementById("subtotal");
const discountDisplay = document.getElementById("discount");
const totalDisplay = document.getElementById("total");


// Total Calculation Function (Global access via window for selectLocation)
window.calculateTotal = function() {
  if (!startDate.value || !startTime.value || !endDate.value || !endTime.value || !selectedLocationName) {
    // Reset displays if any necessary field is empty
    subtotalDisplay.textContent = "0.00";
    discountDisplay.textContent = "0.00";
    totalDisplay.textContent = "0.00";
    totalInput.value = 0;
    return;
  }

  const start = new Date(`${startDate.value}T${startTime.value}`);
  const end = new Date(`${endDate.value}T${endTime.value}`);
  
  if (end <= start) {
    subtotalDisplay.textContent = "0.00";
    discountDisplay.textContent = "0.00";
    totalDisplay.textContent = "0.00";
    totalInput.value = 0;
    return;
  }

  // Calculate hours, rounded up (e.g., 1.5 hours becomes 2 hours)
  const hours = Math.ceil(Math.abs(end - start) / (1000 * 60 * 60)); 
  const subtotal = hours * currentRate;

  let discount = 0;
  const promo = promoInput.value.trim().toUpperCase();
  if (promo === "SAVE10") discount = subtotal * 0.10;
  else if (promo === "PARK20") discount = subtotal * 0.20;

  const total = subtotal - discount;
  
  subtotalDisplay.textContent = total > 0 ? subtotal.toFixed(2) : "0.00";
  discountDisplay.textContent = total > 0 ? discount.toFixed(2) : "0.00";
  totalDisplay.textContent = total > 0 ? total.toFixed(2) : "0.00";
  totalInput.value = total > 0 ? total.toFixed(2) : 0;
}


window.selectLocation = function(location, floors, rate, id) {
  selectedLocationName = location;
  currentRate = rate;

  // 1. Update form input and indicators
  selectedLocationInput.value = location;
  floorDetailsSection.classList.add('active');
  document.querySelectorAll('.selected-location-indicator').forEach(el => {
    el.classList.remove('active');
  });
  document.getElementById(`selected-${id}`).classList.add('active');

  // 2. Reset and Enable Floor Select Dropdown
  floorList.innerHTML = '';
  floorSelect.innerHTML = '<option value="">Select a floor</option>';
  floorSelect.disabled = false;

  // 3. Populate floors and dropdown
  const floors_data = floorData[location];
  floors_data.forEach(floor => {
    // ... (rest of the floor display logic remains the same) ...
    const percentage = (floor.occupied / floor.capacity) * 100;
    let status = 'available';
    let statusText = 'Available';

    if (percentage >= 100) {
      status = 'full';
      statusText = 'Full';
    } else if (percentage >= 70) {
      status = 'limited';
      statusText = 'Limited';
    }

    const available = floor.capacity - floor.occupied;

    // Add to floor details display
    const floorItem = `
      <div class="floor-item">
        <div class="floor-name">${floor.floor}</div>
        <div class="floor-capacity">
          <span class="capacity-text">${available}/${floor.capacity} available</span>
          <div class="progress-bar-custom">
            <div class="progress-fill ${status}" style="width: ${percentage}%"></div>
          </div>
          <span class="floor-status ${status}">${statusText}</span>
        </div>
      </div>
    `;
    floorList.innerHTML += floorItem;

    // Add to floor select dropdown (exclude full floors)
    if (status !== 'full') {
      const option = document.createElement('option');
      option.value = floor.floor;
      option.textContent = `${floor.floor} (${available} slots available)`;
      floorSelect.appendChild(option);
    }
  });

  // 4. Recalculate total with new rate and potentially selected floor
  calculateTotal();
}

document.addEventListener("DOMContentLoaded", () => {
  // --- Event Listeners for Total Calculation ---
  const dateAndTimeInputs = [startDate, startTime, endDate, endTime];
  dateAndTimeInputs.forEach(el => el.addEventListener("change", calculateTotal));
  promoInput.addEventListener("input", calculateTotal); 
  
  // Also recalculate if the floor is selected/changed (optional logic based on floor)
  floorSelect.addEventListener("change", calculateTotal);

  // --- INITIALIZE FORM STATE ---
  // Automatically select the first location on page load for initial setup.
  const initialLocationSlide = document.querySelector('.location-slide');
  if (initialLocationSlide) {
      const location = initialLocationSlide.dataset.location;
      const floors = initialLocationSlide.dataset.floors;
      const rate = initialLocationSlide.dataset.rate;
      const id = 'qc'; // ID for the first location
      window.selectLocation(location, floors, rate, id);
  }
});
  </script>

  <!-- Location Slider Script -->
  <script>
document.addEventListener("DOMContentLoaded", () => {
  const slider = document.getElementById('locationSlider');
  const slides = document.querySelectorAll('.location-slide');
  const dots = document.querySelectorAll('.dot');
  let currentSlide = 0;
  let startX = 0;
  let isDragging = false;
  let isClick = true; 

  // Update slider position
  function updateSlider() {
    slider.style.transform = `translateX(-${currentSlide * 100}%)`;

    slides.forEach((slide, index) => {
      slide.classList.toggle('active', index === currentSlide);
    });

    dots.forEach((dot, index) => {
      dot.classList.toggle('active', index === currentSlide);
    });
  }

  // Go to specific slide
  function goToSlide(index) {
    currentSlide = Math.max(0, Math.min(index, slides.length - 1));
    updateSlider();
  }

  // Dot navigation
  dots.forEach((dot, index) => {
    dot.addEventListener('click', () => goToSlide(index));
  });

  // Touch/Mouse events for swiping
  slider.addEventListener('mousedown', startDrag);
  slider.addEventListener('touchstart', startDrag, { passive: true });

  // Attach drag listeners to the document for robustness
  document.addEventListener('mousemove', drag);
  document.addEventListener('touchmove', drag, { passive: false });
  
  document.addEventListener('mouseup', endDrag);
  document.addEventListener('touchend', endDrag);
  
  slider.addEventListener('mouseleave', () => {
    if (isDragging) endDrag({ pageX: startX, changedTouches: [{ pageX: startX }] });
  });

  function startDrag(e) {
    // === CRITICAL FIX ===
    // If the mousedown/touchstart event originated on the "Select Location" button,
    // we must prevent the drag from ever starting. The button's native click will then fire on mouseup.
    if (e.target.closest('.select-location-btn')) {
        isDragging = false;
        return; 
    }
    // ====================

    isDragging = true;
    isClick = true; 
    startX = e.type.includes('mouse') ? e.pageX : e.touches[0].pageX;
    slider.style.cursor = 'grabbing';
    slider.style.transition = 'none';
  }

  function drag(e) {
    if (!isDragging) return;
    
    const currentX = e.type.includes('mouse') ? e.pageX : e.touches[0].pageX;
    const diff = currentX - startX;
    
    // Check if movement is significant enough to be considered a drag
    if (Math.abs(diff) > 5) {
        isClick = false;
    }
    
    // Visually drag the slide
    const slideWidth = slides[0].offsetWidth;
    const offset = currentSlide * slideWidth;
    slider.style.transform = `translateX(${-offset + diff}px)`;
    
    if (e.cancelable) e.preventDefault();
  }

  function endDrag(e) {
    if (!isDragging) return;
    isDragging = false;
    slider.style.cursor = 'grab';
    slider.style.transition = 'transform 0.5s ease';
    
    // If it was a click (no drag), just snap back to position and exit. 
    // The button's click event (if any) will fire next.
    if (isClick) {
        updateSlider(); 
        return; 
    }

    const endX = e.type.includes('mouse') ? e.pageX : e.changedTouches[0].pageX;
    const diff = startX - endX;
    
    const swipeThreshold = slider.offsetWidth * 0.2; 
    
    if (Math.abs(diff) > swipeThreshold) {
      if (diff > 0) { // Swiped left (Next slide)
        currentSlide = Math.min(currentSlide + 1, slides.length - 1);
      } else { // Swiped right (Previous slide)
        currentSlide = Math.max(currentSlide - 1, 0);
      }
    }
    
    updateSlider();
  }

  // Auto-advance every 5 seconds
  setInterval(() => {
    currentSlide = (currentSlide + 1) % slides.length;
    updateSlider();
  }, 5000);
});
  </script>
<script src="parking.js"></script>
</body>
</html>
>>>>>>> Stashed changes
