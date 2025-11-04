<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    if (password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_name'] = $user['fullname'];
      header("Location: index.php");
      exit();
    } else {
      echo "<script>alert('Invalid password!'); window.location.href='login_register.php';</script>";
    }
  } else {
    echo "<script>alert('No account found with that email!'); window.location.href='login_register.php';</script>";
  }
}
?>
