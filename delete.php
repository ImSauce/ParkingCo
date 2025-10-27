<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM reservations WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Reservation deleted successfully'); window.location='view_reservations.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
