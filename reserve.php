<?php
session_start();
include 'connect.php';


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit();
}


$full_name   = mysqli_real_escape_string($conn, $_POST['fullname']);
$email       = mysqli_real_escape_string($conn, $_POST['email']);
$floor       = mysqli_real_escape_string($conn, $_POST['floor']);   
$start_date  = $_POST['start_date'];
$start_time  = $_POST['start_time'];
$end_date    = $_POST['end_date'];
$end_time    = $_POST['end_time'];
$promo_code  = mysqli_real_escape_string($conn, $_POST['promo_code']);
$total       = floatval($_POST['total']);


$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;


$sql = "
    INSERT INTO reservations (
        full_name, email, slot,
        start_date, start_time,
        end_date, end_time,
        promo_code, total, status
    )
    VALUES (
        '$full_name', '$email', '$floor',
        '$start_date', '$start_time',
        '$end_date', '$end_time',
        '$promo_code', $total, 'Pending'
    )
";

if (!mysqli_query($conn, $sql)) {
    die("Database Insert Error: " . mysqli_error($conn));
}


$update = "
    UPDATE floors
    SET occupied = occupied + 1
    WHERE floor_name = '$floor'
";

mysqli_query($conn, $update);


header("Location: index.php?success=1");
exit();
?>
