<?php
session_start();
session_unset();   // Clears all session variables
session_destroy(); // Destroys session

header("Location: login.php?message=Logged out successfully");
exit();
?>