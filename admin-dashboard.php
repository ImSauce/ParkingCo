<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin-login.php");
    exit();
}

include 'connect.php';

// Get statistics
$total_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM users"))['count'];
$total_reservations = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM reservations"))['count'];
$total_products = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM products"))['count'];
$total_revenue = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(total) as revenue FROM reservations"))['revenue'] ?? 0;

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - ParkingCo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
      color: #fff;
      font-family: "Segoe UI", Arial, sans-serif;
      min-height: 100vh;
    }
    
    .admin-header {
      background: rgba(0, 0, 0, 0.3);
      padding: 20px 0;
      border-bottom: 2px solid rgba(46, 91, 227, 0.5);
    }
    
    .welcome-box {
      background: linear-gradient(135deg, #2e5be3, #7622c4);
      padding: 30px;
      border-radius: 15px;
      margin-bottom: 30px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }
    
    .stat-card {
      background: rgba(255, 255, 255, 0.05);
      border: 2px solid rgba(46, 91, 227, 0.3);
      border-radius: 15px;
      padding: 25px;
      margin-bottom: 20px;
      transition: all 0.3s ease;
    }
    
    .stat-card:hover {
      transform: translateY(-5px);
      border-color: #2e5be3;
      box-shadow: 0 10px 30px rgba(46, 91, 227, 0.3);
    }
    
    .stat-icon {
      font-size: 40px;
      margin-bottom: 15px;
    }
    
    .stat-number {
      font-size: 36px;
      font-weight: bold;
      color: #2e5be3;
    }
    
    .stat-label {
      color: #aaa;
      font-size: 14px;
      text-transform: uppercase;
    }
    
    .action-card {
      background: rgba(255, 255, 255, 0.05);
      border: 2px solid rgba(46, 91, 227, 0.3);
      border-radius: 15px;
      padding: 30px;
      text-align: center;
      transition: all 0.3s ease;
      cursor: pointer;
      text-decoration: none;
      display: block;
      color: #fff;
    }
    
    .action-card:hover {
      background: rgba(46, 91, 227, 0.2);
      border-color: #2e5be3;
      transform: translateY(-5px);
      color: #fff;
    }
    
    .action-icon {
      font-size: 50px;
      margin-bottom: 15px;
      color: #2e5be3;
    }
    
    .btn-logout {
      background: linear-gradient(90deg, #dc3545, #c82333);
      border: none;
      padding: 10px 25px;
      border-radius: 25px;
      color: white;
      font-weight: bold;
      transition: all 0.3s ease;
    }
    
    .btn-logout:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
      color: white;
    }
  </style>
</head>
<body>
  <!-- Header -->
  <div class="admin-header">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
          <img src="images/WEBLOGO.png" alt="ParkingCo Logo" height="60">
          <div>
            <h4 class="mb-0">Admin Panel</h4>
            <small class="text-muted">Management Dashboard</small>
          </div>
        </div>
        <div class="d-flex align-items-center gap-3">
          <div class="text-end">
            <div class="fw-bold"><?php echo $_SESSION['admin_name']; ?></div>
            <small class="text-muted">Administrator</small>
          </div>
          <a href="admin-logout.php" class="btn btn-logout">
            <i class="fas fa-sign-out-alt"></i> Logout
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="container py-5">
    <!-- Welcome Box -->
    <div class="welcome-box">
      <h2><i class="fas fa-chart-line"></i> Welcome back, <?php echo $_SESSION['admin_name']; ?>!</h2>
      <p class="mb-0">Here's an overview of your ParkingCo management system</p>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-5">
      <div class="col-md-3">
        <div class="stat-card text-center">
          <div class="stat-icon"><i class="fas fa-users text-primary"></i></div>
          <div class="stat-number"><?php echo $total_users; ?></div>
          <div class="stat-label">Total Users</div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="stat-card text-center">
          <div class="stat-icon"><i class="fas fa-calendar-check text-success"></i></div>
          <div class="stat-number"><?php echo $total_reservations; ?></div>
          <div class="stat-label">Reservations</div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="stat-card text-center">
          <div class="stat-icon"><i class="fas fa-box text-warning"></i></div>
          <div class="stat-number"><?php echo $total_products; ?></div>
          <div class="stat-label">Products</div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="stat-card text-center">
          <div class="stat-icon"><i class="fas fa-peso-sign text-info"></i></div>
          <div class="stat-number">₱<?php echo number_format($total_revenue, 2); ?></div>
          <div class="stat-label">Total Revenue</div>
        </div>
      </div>
    </div>

    <!-- Management Actions -->
    <h3 class="mb-4"><i class="fas fa-tools"></i> Management Tools</h3>
    <div class="row">
      <div class="col-md-4 mb-4">
        <a href="user-maintenance.php" class="action-card">
          <div class="action-icon"><i class="fas fa-users-cog"></i></div>
          <h5>User Maintenance</h5>
          <p class="text-muted mb-0">Add, Edit, Delete Users</p>
        </a>
      </div>
      <div class="col-md-4 mb-4">
        <a href="product-maintenance.php" class="action-card">
          <div class="action-icon"><i class="fas fa-boxes"></i></div>
          <h5>Product Maintenance</h5>
          <p class="text-muted mb-0">Manage Products & Images</p>
        </a>
      </div>
      <div class="col-md-4 mb-4">
        <a href="view_reservations.php" class="action-card">
          <div class="action-icon"><i class="fas fa-list-alt"></i></div>
          <h5>View Reservations</h5>
          <p class="text-muted mb-0">Monitor All Bookings</p>
        </a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>