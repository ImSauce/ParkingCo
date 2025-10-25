<?php
include 'connect.php';
$sql = "SELECT * FROM reservations ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reservations - ParkingCo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">
    <div class="container py-5">
        <h2 class="text-center mb-4 text-primary fw-bold">All Parking Reservations</h2>
        <table class="table table-bordered table-striped table-dark align-middle text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Slot</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['full_name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['slot']}</td>
                                <td>{$row['start_datetime']}</td>
                                <td>{$row['end_datetime']}</td>
                                <td>₱{$row['total']}</td>
                                <td>
                                    <a href='edit.php?id={$row['id']}' class='btn btn-warning btn-sm me-2'>Edit</a>
                                    <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center text-muted'>No reservations yet</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="text-center mt-4">
            <a href="index.html" class="btn btn-primary">Back to Home</a>
        </div>
    </div>
</body>
</html>
