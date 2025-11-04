<?php
include 'connect.php';

if (!isset($_GET['location']) || empty($_GET['location'])) {
    echo json_encode([]);
    exit;
}

$location = mysqli_real_escape_string($conn, $_GET['location']);

$sql = "SELECT floor_name, capacity, occupied 
        FROM floors 
        WHERE location = '$location'
        ORDER BY floor_name ASC";

$result = mysqli_query($conn, $sql);

$floors = [];

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $row['capacity'] = (int)$row['capacity'];
        $row['occupied'] = (int)$row['occupied'];
        $floors[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($floors);
?>
