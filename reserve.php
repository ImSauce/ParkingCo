<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname   = $_POST['fullname'];
    $email      = $_POST['email'];
    $slot       = $_POST['slot'];
    $start_date = $_POST['start_date'];
    $start_time = $_POST['start_time'];
    $end_date   = $_POST['end_date'];
    $end_time   = $_POST['end_time'];
    $promo_code = $_POST['promo_code'];
    $total      = $_POST['total'];

    $sql = "INSERT INTO reservations (full_name, email, slot, start_date, start_time, end_date, end_time, promo_code, total)
            VALUES ('$fullname', '$email', '$slot', '$start_date', '$start_time', '$end_date', '$end_time', '$promo_code', '$total')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Reservation submitted successfully!');
                window.location='index.html';
              </script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
