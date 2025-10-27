<?php
include 'connect.php';

$sql = "CREATE TABLE IF NOT EXISTS reservations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  fullname VARCHAR(100),
  email VARCHAR(100),
  slot VARCHAR(10),
  start_date DATE,
  start_time TIME,
  end_date DATE,
  end_time TIME,
  promo_code VARCHAR(50),
  total DECIMAL(10,2),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
  echo "Table 'reservations' created successfully!";
} else {
  echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
