<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin-login.php");
    exit();
}

include 'connect.php';

// Handle Add Product with Image Upload
if (isset($_POST['add_product'])) {
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = floatval($_POST['price']);
    $stock = intval($_POST['stock']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    
    // Handle image upload
    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/products/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $file_extension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        $allowed_extensions = array("jpg", "jpeg", "png", "gif");
        
        if (in_array($file_extension, $allowed_extensions)) {
            $new_filename = "product_" . time() . "_" . uniqid() . "." . $file_extension;
            $target_file = $target_dir . $new_filename;
            
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image = $target_file;
            }
        }
    }
    
    $sql = "INSERT INTO products (product_name, description, price, stock, category, image) 
            VALUES ('$product_name', '$description', $price, $stock, '$category', '$image')";
    
    if (mysqli_query($conn, $sql)) {
        $success = "Product added successfully!";
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}

// Handle Delete Product
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    // Get image path before deleting
    $result = mysqli_query($conn, "SELECT image FROM products WHERE id=$id");
    $product = mysqli_fetch_assoc($result);
    if ($product && $product['image'] && file_exists($product['image'])) {
        unlink($product['image']); // Delete image file
    }
    
    $sql = "DELETE FROM products WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        $success = "Product deleted successfully!";
    }
}

// Handle Edit Product
if (isset($_POST['edit_product'])) {
    $id = intval($_POST['id']);
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = floatval($_POST['price']);
    $stock = intval($_POST['stock']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    
    // Handle image upload for edit
    $image_sql = "";
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Delete old image
        $result = mysqli_query($conn, "SELECT image FROM products WHERE id=$id");
        $old_product = mysqli_fetch_assoc($result);
        if ($old_product && $old_product['image'] && file_exists($old_product['image'])) {
            unlink($old_product['image']);
        }
        
        $target_dir = "uploads/products/";
        $file_extension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        $new_filename = "product_" . time() . "_" . uniqid() . "." . $file_extension;
        $target_file = $target_dir . $new_filename;
        
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_sql = ", image='$target_file'";
        }
    }
    
    $sql = "UPDATE products SET product_name='$product_name', description='$description', 
            price=$price, stock=$stock, category='$category' $image_sql WHERE id=$id";
    
    if (mysqli_query($conn, $sql)) {
        $success = "Product updated successfully!";
    }
}

// Fetch all products
$products = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Maintenance - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body { background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); color: #fff; min-height: 100vh; }
    .admin-header { background: rgba(0, 0, 0, 0.3); padding: 15px 0; border-bottom: 2px solid rgba(46, 91, 227, 0.5); margin-bottom: 30px; }
    .content-card { background: rgba(255, 255, 255, 0.05); border: 2px solid rgba(46, 91, 227, 0.3); border-radius: 15px; padding: 30px; margin-bottom: 30px; }
    .product-img { width: 80px; height: 80px; object-fit: cover; border-radius: 8px; border: 2px solid #2e5be3; }
    .table-dark { background: rgba(0, 0, 0, 0.3); }
    .btn-action { padding: 5px 12px; font-size: 13px; margin: 0 2px; }
    .alert-success { background: rgba(40, 167, 69, 0.2); border-color: #28a745; color: #4ade80; }
    .image-preview { max-width: 200px; max-height: 200px; margin-top: 10px; border-radius: 8px; }
  </style>
</head>
<body>
  <div class="admin-header">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <h4><i class="fas fa-boxes"></i> Product Maintenance</h4>
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

    <!-- Add New Product Form -->
    <div class="content-card">
      <h5 class="mb-4"><i class="fas fa-plus-circle"></i> Add New Product</h5>
      <form method="POST" enctype="multipart/form-data" class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Product Name *</label>
          <input type="text" name="product_name" class="form-control" required>
        </div>
        <div class="col-md-3">
          <label class="form-label">Price (₱) *</label>
          <input type="number" step="0.01" name="price" class="form-control" required>
        </div>
        <div class="col-md-3">
          <label class="form-label">Stock *</label>
          <input type="number" name="stock" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Category</label>
          <input type="text" name="category" class="form-control" placeholder="e.g., Passes, Services">
        </div>
        <div class="col-md-6">
          <label class="form-label">Product Image</label>
          <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(this, 'preview-add')">
          <img id="preview-add" class="image-preview" style="display:none;">
        </div>
        <div class="col-12">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control" rows="3"></textarea>
        </div>
        <div class="col-12">
          <button type="submit" name="add_product" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Product
          </button>
        </div>
      </form>
    </div>

    <!-- Products List -->
    <div class="content-card">
      <h5 class="mb-4"><i class="fas fa-list"></i> All Products</h5>
      <div class="table-responsive">
        <table class="table table-dark table-striped table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Image</th>
              <th>Product Name</th>
              <th>Category</th>
              <th>Price</th>
              <th>Stock</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($product = mysqli_fetch_assoc($products)): ?>
            <tr>
              <td><?php echo $product['id']; ?></td>
              <td>
                <?php if ($product['image'] && file_exists($product['image'])): ?>
                  <img src="<?php echo $product['image']; ?>" class="product-img">
                <?php else: ?>
                  <div class="product-img d-flex align-items-center justify-content-center bg-secondary">
                    <i class="fas fa-image"></i>
                  </div>
                <?php endif; ?>
              </td>
              <td><?php echo htmlspecialchars($product['product_name']); ?></td>
              <td><?php echo htmlspecialchars($product['category']); ?></td>
              <td>₱<?php echo number_format($product['price'], 2); ?></td>
              <td><?php echo $product['stock']; ?></td>
              <td>
                <button class="btn btn-warning btn-action btn-sm" data-bs-toggle="modal" 
                        data-bs-target="#editModal<?php echo $product['id']; ?>">
                  <i class="fas fa-edit"></i> Edit
                </button>
                <a href="?delete=<?php echo $product['id']; ?>" class="btn btn-danger btn-action btn-sm" 
                   onclick="return confirm('Delete this product?')">
                  <i class="fas fa-trash"></i> Delete
                </a>
              </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal<?php echo $product['id']; ?>" tabindex="-1">
              <div class="modal-dialog modal-lg">
                <div class="modal-content bg-dark text-light">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit Product: <?php echo htmlspecialchars($product['product_name']); ?></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                  </div>
                  <form method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                      <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                      <div class="row g-3">
                        <div class="col-md-6">
                          <label class="form-label">Product Name</label>
                          <input type="text" name="product_name" class="form-control" value="<?php echo htmlspecialchars($product['product_name']); ?>" required>
                        </div>
                        <div class="col-md-3">
                          <label class="form-label">Price (₱)</label>
                          <input type="number" step="0.01" name="price" class="form-control" value="<?php echo $product['price']; ?>" required>
                        </div>
                        <div class="col-md-3">
                          <label class="form-label">Stock</label>
                          <input type="number" name="stock" class="form-control" value="<?php echo $product['stock']; ?>" required>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Category</label>
                          <input type="text" name="category" class="form-control" value="<?php echo htmlspecialchars($product['category']); ?>">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Change Image</label>
                          <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(this, 'preview-edit-<?php echo $product['id']; ?>')">
                          <?php if ($product['image'] && file_exists($product['image'])): ?>
                            <img src="<?php echo $product['image']; ?>" id="preview-edit-<?php echo $product['id']; ?>" class="image-preview">
                          <?php else: ?>
                            <img id="preview-edit-<?php echo $product['id']; ?>" class="image-preview" style="display:none;">
                          <?php endif; ?>
                        </div>
                        <div class="col-12">
                          <label class="form-label">Description</label>
                          <textarea name="description" class="form-control" rows="3"><?php echo htmlspecialchars($product['description']); ?></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      <button type="submit" name="edit_product" class="btn btn-primary">Save Changes</button>
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
  <script>
    function previewImage(input, previewId) {
      const preview = document.getElementById(previewId);
      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
          preview.src = e.target.result;
          preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
</body>
</html>