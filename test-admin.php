<?php

include 'connect.php';

echo "<h2>Admin Login Debugging</h2>";


echo "<h3>Test 1: Database Connection</h3>";
if ($conn) {
    echo "✅ Connected to database successfully<br><br>";
} else {
    echo "❌ Database connection failed: " . mysqli_connect_error() . "<br><br>";
    exit();
}


echo "<h3>Test 2: Check Admins Table</h3>";
$result = mysqli_query($conn, "SHOW TABLES LIKE 'admins'");
if (mysqli_num_rows($result) > 0) {
    echo "✅ Admins table exists<br><br>";
} else {
    echo "❌ Admins table does NOT exist<br><br>";
    exit();
}


echo "<h3>Test 3: Admin Data</h3>";
$sql = "SELECT * FROM admins WHERE username = 'Admin'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "✅ Admin user found!<br>";
    $admin = mysqli_fetch_assoc($result);
    echo "<strong>Username:</strong> " . $admin['username'] . "<br>";
    echo "<strong>Password Hash:</strong> " . substr($admin['password'], 0, 30) . "...<br>";
    echo "<strong>Hash Length:</strong> " . strlen($admin['password']) . " characters<br><br>";
    
    echo "<h3>Test 4: Password Verification</h3>";
    $test_password = "admin@123";
    
    echo "Testing password: <strong>$test_password</strong><br>";
    
    if (password_verify($test_password, $admin['password'])) {
        echo "✅ Password verification SUCCESS!<br>";
        echo "👉 <strong>Login should work now!</strong><br><br>";
    } else {
        echo "❌ Password verification FAILED<br>";
        echo "<br><strong>Solution:</strong> The password hash is wrong. Run this SQL:<br>";
        echo "<textarea style='width:100%; height:100px; font-family:monospace;'>";
        
        $correct_hash = password_hash($test_password, PASSWORD_DEFAULT);
        echo "UPDATE admins SET password = '$correct_hash' WHERE username = 'Admin';";
        echo "</textarea><br><br>";
    }
} else {
    echo "❌ Admin user NOT found in database<br>";
    echo "<br><strong>Solution:</strong> Run this SQL to create admin:<br>";
    echo "<textarea style='width:100%; height:150px; font-family:monospace;'>";
    $new_hash = password_hash("admin@123", PASSWORD_DEFAULT);
    echo "INSERT INTO admins (username, password, full_name, email) VALUES\n";
    echo "('Admin', '$new_hash', 'System Administrator', 'admin@parkingco.com');";
    echo "</textarea><br><br>";
}


echo "<h3>Test 5: All Admin Accounts</h3>";
$all_admins = mysqli_query($conn, "SELECT id, username, full_name, email FROM admins");
if (mysqli_num_rows($all_admins) > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>Username</th><th>Full Name</th><th>Email</th></tr>";
    while ($row = mysqli_fetch_assoc($all_admins)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['full_name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No admin accounts found.";
}

mysqli_close($conn);
?>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        background: #f5f5f5;
    }
    h2 { color: #333; }
    h3 { 
        color: #2e5be3; 
        margin-top: 20px;
        border-bottom: 2px solid #2e5be3;
        padding-bottom: 5px;
    }
    textarea {
        margin-top: 10px;
        padding: 10px;
        border: 2px solid #2e5be3;
        border-radius: 5px;
    }
    table {
        background: white;
        border-collapse: collapse;
    }
    th {
        background: #2e5be3;
        color: white;
    }
</style>