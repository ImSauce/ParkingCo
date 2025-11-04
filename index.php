<?php
session_start();

// If user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?message=Please login first");
    exit();
}
include 'connect.php';
$products = mysqli_query($conn, "SELECT * FROM products WHERE stock > 0 ORDER BY product_name ASC");
?>
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
    <div class="container-fluid">
      <a class="navbar-brand fw-bold text-primary" href="#"> 
        <img src="images/WEBLOGO.png" alt="Okada Logo" height="80"> 
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link active nav-link-expand" href="#home">Home</a></li>
          <li class="nav-item">
            <a class="nav-link nav-link-expand" href="Aboutus.html" onclick="window.location.href='Aboutus.html'; return false;">About</a>
          </li>
          <li class="nav-item"><a class="nav-link nav-link-expand" href="#reservation">Reserve</a></li>
          <li class="nav-item"><a class="nav-link nav-link-expand" href="#contact">Contact</a></li>
          <li class="nav-item"><a class="nav-link nav-link-expand" href="logout.php">Logout</a></li>
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
        <a href="#reservation" class="btn btn-primary btn-lg me-2">Reserve Now</a>
        <a href="#about" class="btn btn-outline-light btn-lg">Learn More</a>
      </div>
    </div>
  </header>

   <!-- ABOUT SECTION -->
  <section class="about-page d-flex align-items-center min-vh-100">
    <div class="container text-light">
      <div class="row align-items-center">
        <!-- LEFT SIDE: TEXT -->
        <div class="col-md-7">
          <h2 class="fw-bold text-primary mb-4">ABOUT US</h2>
          <p class="fs-5 mb-5">
            ParkingCo was created to solve a common problem in urban locations: the difficulty many drivers experience trying to find parking. 
            That inefficient search for a paid parking spot is frustrating, and also contributes to a lack of flow and congestion.
          </p>

          <h3 class="fw-bold text-primary mb-4">Group Members</h3>
          <div class="d-flex flex-wrap gap-4 justify-content-start">
            <div class="member text-center">
              <img src="images/miura.png" alt="Miura Yu" class="member-img mb-2">
              <p>YU, MIURA</p>
            </div>
            <div class="member text-center">
              <img src="images/samuel.png" alt="Samuel Cinco" class="member-img mb-2">
              <p>CINCO, SAMUEL JAMES A.</p>
            </div>
            <div class="member text-center">
              <img src="images/steven.png" alt="Steven Macawile" class="member-img mb-2">
              <p>MACAWILE, STEVEN LORENZ Y.</p>
            </div>
            <div class="member text-center">
              <img src="images/cliff.png" alt="Cliff Bautista" class="member-img mb-2">
              <p>BAUTISTA, CLIFF JEFFERSON S.</p>
            </div>
          </div>
        </div>

        <!-- RIGHT SIDE: LOGO -->
        <div class="col-md-5 text-center">
          <img src="images/WEBLOGO.png" alt="ParkingCo Logo" class="img-fluid about-logo">
        </div>
      </div>
    </div>
  </section>

  <!-- SCHEDULE FORM -->
  <section id="reservation" class="slots-section">
    <div class="slots-container">
      <!-- LEFT: Schedule Form -->
      <div class="schedule-form p-4 rounded">
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
              <label>Selected Location</label>
              <input type="text" id="selectedLocationInput" name="location" class="form-control" readonly required>
            </div>
            <div class="col-md-6">
              <label>Select Floor</label>
              <select id="floorSelect" name="floor" class="form-select" required disabled>
                <option value="">Choose location first</option>
              </select>
            </div>
             <div class="col-12">
    <label>Select Product / Service</label>
    <select name="product_id" class="form-select" required>
        <option value="0" data-price="0" selected>None — ₱0.00</option>

        <?php while ($p = mysqli_fetch_assoc($products)): ?>
            <option value="<?= $p['id'] ?>" data-price="<?= $p['price'] ?>">
                <?= htmlspecialchars($p['product_name']) ?> — ₱<?= number_format($p['price'], 2) ?>
            </option>
        <?php endwhile; ?>
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

          <!-- Display subtotal/discount/total -->
          <div class="text-end mt-3">
            <p>Subtotal: ₱<span id="subtotal">0.00</span></p>
            <p>Discount: ₱<span id="discount">0.00</span></p>
            <p><strong>Total: ₱<span id="total">0.00</span></strong></p>
          </div>

          <button type="submit" class="btn btn-primary w-100 mt-2">PROCEED PAYMENT</button>
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
    </div>
  </section>

  <!-- CONTACT -->
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
            <p class="text-white">
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
            <p class="text-white mb-3">Subscribe to get special offers and parking tips!</p>
            <form class="newsletter-form">
              <div class="input-group">
                <input type="email" class="form-control" placeholder="Your email" required>
                <button class="btn btn-primary" type="submit">
                  <i class="fas fa-paper-plane"></i>
                </button>
              </div>
            </form>
            <div class="payment-methods mt-4">
              <small class="text-white d-block mb-2">We Accept:</small>
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
            <p class="mb-0 text-white">
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

  function selectLocation(location, floors, rate, id) {
    selectedLocationName = location;
    currentRate = rate;

    document.getElementById('selectedLocationInput').value = location;

    const floorDetailsSection = document.getElementById('floorDetails');
    const floorList = document.getElementById('floorList');
    const floorSelect = document.getElementById('floorSelect');

    floorDetailsSection.classList.add('active');
    floorList.innerHTML = '';
    floorSelect.innerHTML = '<option value="">Select a floor</option>';
    floorSelect.disabled = false;

    document.querySelectorAll('.selected-location-indicator').forEach(el => {
      el.classList.remove('active');
    });

    document.getElementById(`selected-${id}`).classList.add('active');

    const floors_data = floorData[location];
    floors_data.forEach(floor => {
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

      if (status !== 'full') {
        const option = document.createElement('option');
        option.value = floor.floor;
        option.textContent = `${floor.floor} (${available} slots available)`;
        floorSelect.appendChild(option);
      }
    });

    calculateTotal();
  }

  // ✅ UPDATED CALCULATION SCRIPT INCLUDING PRODUCT PRICE
  document.addEventListener("DOMContentLoaded", () => {
    const startDate = document.querySelector('input[name="start_date"]');
    const startTime = document.querySelector('input[name="start_time"]');
    const endDate = document.querySelector('input[name="end_date"]');
    const endTime = document.querySelector('input[name="end_time"]');
    const promoInput = document.querySelector('input[name="promo_code"]');
    const productSelect = document.querySelector('select[name="product_id"]');
    const totalInput = document.querySelector('input[name="total"]');

    const subtotalDisplay = document.getElementById("subtotal");
    const discountDisplay = document.getElementById("discount");
    const totalDisplay = document.getElementById("total");

    window.calculateTotal = function () {

      if (!startDate.value || !startTime.value || !endDate.value || !endTime.value) return;

      const start = new Date(`${startDate.value}T${startTime.value}`);
      const end = new Date(`${endDate.value}T${endTime.value}`);

      if (end <= start) {
        subtotalDisplay.textContent = "0.00";
        discountDisplay.textContent = "0.00";
        totalDisplay.textContent = "0.00";
        totalInput.value = 0;
        return;
      }

      // ✅ Parking hours
      const hours = Math.abs(end - start) / (1000 * 60 * 60);
      let subtotal = hours * currentRate;

      // ✅ Product Price
      const selectedOption = productSelect.options[productSelect.selectedIndex];
      const productPrice = Number(selectedOption.dataset.price || 0);
      subtotal += productPrice;

      // ✅ Promo
      let discount = 0;
      const promo = promoInput.value.trim().toUpperCase();

      if (promo === "SAVE10") discount = subtotal * 0.10;
      else if (promo === "PARK20") discount = subtotal * 0.20;

      const total = subtotal - discount;

      subtotalDisplay.textContent = subtotal.toFixed(2);
      discountDisplay.textContent = discount.toFixed(2);
      totalDisplay.textContent = total.toFixed(2);
      totalInput.value = total.toFixed(2);
    };

    // ✅ Recalculate on promo input
    promoInput.addEventListener("input", () => {
      const promo = promoInput.value.trim().toUpperCase();
      if (promo === "SAVE10") alert("Promo applied: 10% OFF!");
      else if (promo === "PARK20") alert("Promo applied: 20% OFF!");
      calculateTotal();
    });

    // ✅ Recalculate on date/time changes
    [startDate, startTime, endDate, endTime].forEach(el => el.addEventListener("change", calculateTotal));

    // ✅ Recalculate when product changes
    productSelect.addEventListener("change", calculateTotal);

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

    // Update slider position
    function updateSlider() {
      slider.style.transform = `translateX(-${currentSlide * 100}%)`;
      
      // Update active slide
      slides.forEach((slide, index) => {
        slide.classList.toggle('active', index === currentSlide);
      });
      
      // Update active dot
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
    slider.addEventListener('touchstart', startDrag);
    
    slider.addEventListener('mousemove', drag);
    slider.addEventListener('touchmove', drag);
    
    slider.addEventListener('mouseup', endDrag);
    slider.addEventListener('mouseleave', endDrag);
    slider.addEventListener('touchend', endDrag);

    function startDrag(e) {
      isDragging = true;
      startX = e.type.includes('mouse') ? e.pageX : e.touches[0].pageX;
      slider.style.cursor = 'grabbing';
    }

    function drag(e) {
      if (!isDragging) return;
      e.preventDefault();
    }

    function endDrag(e) {
      if (!isDragging) return;
      isDragging = false;
      slider.style.cursor = 'grab';
      
      const endX = e.type.includes('mouse') ? e.pageX : e.changedTouches[0].pageX;
      const diff = startX - endX;
      
      // Swipe threshold
      if (Math.abs(diff) > 50) {
        if (diff > 0 && currentSlide < slides.length - 1) {
          currentSlide++;
        } else if (diff < 0 && currentSlide > 0) {
          currentSlide--;
        }
        updateSlider();
      }
    }

    // Auto-advance every 5 seconds
    setInterval(() => {
      currentSlide = (currentSlide + 1) % slides.length;
      updateSlider();
    }, 5000);
  });
  </script>
 <script src="parking.js"></script>
 <script>
document.addEventListener("DOMContentLoaded", function() {
    const logoutLink = document.querySelector('a[href="logout.php"]');
    if (logoutLink) {
        logoutLink.addEventListener("click", function(e) {
            e.preventDefault(); 
            window.location.href = "logout.php";
        });
    }
});
</script>
</body>
</html>