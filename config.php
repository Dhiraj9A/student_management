<?php
// Database config - update with your credentials
$db_host = 'localhost';
$db_user = 'root';
$db_pass = 'Dhiraj@1234';
$db_name = 'student_mgmt';

// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
