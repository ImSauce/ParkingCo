<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM reservations WHERE id=$id");
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $slot = $_POST['slot'];
    $start_datetime = $_POST['start_datetime'];
    $end_datetime = $_POST['end_datetime'];
    $total = $_POST['total'];

    $update = "UPDATE reservations 
               SET full_name='$full_name', email='$email', slot='$slot', 
                   start_datetime='$start_datetime', end_datetime='$end_datetime', total='$total' 
               WHERE id=$id";

    if ($conn->query($update) === TRUE) {
        echo "<script>alert('Reservation updated successfully'); window.location='view_reservations.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">
    <div class="container py-5">
        <h2 class="text-center text-primary mb-4 fw-bold">Edit Reservation</h2>
        <form method="POST" class="p-4 bg-secondary rounded">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">

            <div class="mb-3">
                <label>Full Name</label>
                <input type="text" name="full_name" value="<?= $row['full_name'] ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" value="<?= $row['email'] ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Slot</label>
                <input type="text" name="slot" value="<?= $row['slot'] ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Start Date & Time</label>
                <input type="datetime-local" name="start_datetime" value="<?= $row['start_datetime'] ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>End Date & Time</label>
                <input type="datetime-local" name="end_datetime" value="<?= $row['end_datetime'] ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Total (₱)</label>
                <input type="number" step="0.01" name="total" value="<?= $row['total'] ?>" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Save Changes</button>
        </form>
        <div class="text-center mt-3">
            <a href="view_reservations.php" class="btn btn-outline-light">Back</a>
        </div>
    </div>
</body>
</html>
