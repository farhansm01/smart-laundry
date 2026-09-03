<?php
$host = "localhost";  // database server
$user = "root";       // database user
$pass = "";           // database password
$dbname = "smart_laundry_db"; // database name

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
?>
