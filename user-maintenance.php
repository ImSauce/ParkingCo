<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin-login.php");
    exit();
}

include 'connect.php';

// Handle Add User
if (isset($_POST['add_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    
    $sql = "INSERT INTO users (username, email, password, full_name, phone, address) 
            VALUES ('$username', '$email', '$password', '$full_name', '$phone', '$address')";
    
    if (mysqli_query($conn, $sql)) {
        $success = "User added successfully!";
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}

// Handle Delete User
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $sql = "DELETE FROM users WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        $success = "User deleted successfully!";
    }
}

// Handle Edit User
if (isset($_POST['edit_user'])) {
    $id = intval($_POST['id']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    
    $sql = "UPDATE users SET username='$username', email='$email', full_name='$full_name', 
            phone='$phone', address='$address', status='$status' WHERE id=$id";
    
    if (mysqli_query($conn, $sql)) {
        $success = "User updated successfully!";
    }
}

// Fetch all users
$users = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Maintenance - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body { background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); color: #fff; min-height: 100vh; }
    .admin-header { background: rgba(0, 0, 0, 0.3); padding: 15px 0; border-bottom: 2px solid rgba(46, 91, 227, 0.5); margin-bottom: 30px; }
    .content-card { background: rgba(255, 255, 255, 0.05); border: 2px solid rgba(46, 91, 227, 0.3); border-radius: 15px; padding: 30px; margin-bottom: 30px; }
    .table-dark { background: rgba(0, 0, 0, 0.3); }
    .btn-action { padding: 5px 12px; font-size: 13px; margin: 0 2px; }
    .alert-success { background: rgba(40, 167, 69, 0.2); border-color: #28a745; color: #4ade80; }
    .alert-danger { background: rgba(220, 53, 69, 0.2); border-color: #dc3545; color: #ff6b6b; }
  </style>
</head>
<body>
  <div class="admin-header">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <h4><i class="fas fa-users-cog"></i> User Maintenance</h4>
        <a href="admin-dashboard.php" class="btn btn-outline-light btn-sm">
          <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>
      </div>
    </div>
  </div>

  <div class="container">
    <?php if (isset($success)): ?>
      <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?php echo $success; ?></div>
    <?php endif; ?>
    <?php if (isset($error)): ?>
      <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?php echo $error; ?></div>
    <?php endif; ?>

    <!-- Add New User Form -->
    <div class="content-card">
      <h5 class="mb-4"><i class="fas fa-user-plus"></i> Add New User</h5>
      <form method="POST" class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Username *</label>
          <input type="text" name="username" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Email *</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Password *</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Full Name *</label>
          <input type="text" name="full_name" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Phone</label>
          <input type="text" name="phone" class="form-control">
        </div>
        <div class="col-md-6">
          <label class="form-label">Address</label>
          <input type="text" name="address" class="form-control">
        </div>
        <div class="col-12">
          <button type="submit" name="add_user" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add User
          </button>
        </div>
      </form>
    </div>

    <!-- Users List -->
    <div class="content-card">
      <h5 class="mb-4"><i class="fas fa-list"></i> All Users</h5>
      <div class="table-responsive">
        <table class="table table-dark table-striped table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Username</th>
              <th>Email</th>
              <th>Full Name</th>
              <th>Phone</th>
              <th>Status</th>
              <th>Created</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($user = mysqli_fetch_assoc($users)): ?>
            <tr>
              <td><?php echo $user['id']; ?></td>
              <td><?php echo htmlspecialchars($user['username']); ?></td>
              <td><?php echo htmlspecialchars($user['email']); ?></td>
              <td><?php echo htmlspecialchars($user['full_name']); ?></td>
              <td><?php echo htmlspecialchars($user['phone']); ?></td>
              <td>
                <span class="badge bg-<?php echo $user['status'] == 'active' ? 'success' : 'secondary'; ?>">
                  <?php echo ucfirst($user['status']); ?>
                </span>
              </td>
              <td><?php echo date('M d, Y', strtotime($user['created_at'])); ?></td>
              <td>
                <button class="btn btn-warning btn-action btn-sm" data-bs-toggle="modal" 
                        data-bs-target="#editModal<?php echo $user['id']; ?>">
                  <i class="fas fa-edit"></i> Edit
                </button>
                <a href="?delete=<?php echo $user['id']; ?>" class="btn btn-danger btn-action btn-sm" 
                   onclick="return confirm('Delete this user?')">
                  <i class="fas fa-trash"></i> Delete
                </a>
              </td>
            </tr>

            <!-- Edit Modal for each user -->
            <div class="modal fade" id="editModal<?php echo $user['id']; ?>" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content bg-dark text-light">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit User: <?php echo htmlspecialchars($user['username']); ?></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                  </div>
                  <form method="POST">
                    <div class="modal-body">
                      <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                      <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="full_name" class="form-control" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($user['phone']); ?>">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" value="<?php echo htmlspecialchars($user['address']); ?>">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                          <option value="active" <?php echo $user['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                          <option value="inactive" <?php echo $user['status'] == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      <button type="submit" name="edit_user" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>