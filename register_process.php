<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
  if (mysqli_num_rows($check) > 0) {
    echo "<script>alert('Email already registered!'); window.location.href='login_register.php';</script>";
    exit();
  }

  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  $insert = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$hashed_password')";
  if (mysqli_query($conn, $insert)) {
    echo "<script>alert('Registration successful! Please log in.'); window.location.href='login_register.php';</script>";
  } else {
    echo "<script>alert('Something went wrong!'); window.location.href='login_register.php';</script>";
  }
}
?>
