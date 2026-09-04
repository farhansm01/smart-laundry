<?php
session_start();

// Redirect to login if user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$username = $_SESSION['username'];
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'Owner';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard | Smart Laundry</title>
</head>
<body>
    <div class="dashboard-wrapper">

    <!-- Left Sidebar Navigation -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2>
                <i class="fa-solid fa-soap"></i>
                Smart Laundry
            </h2>
            <small>Owner Portal</small>
        </div>

        <ul class="sidebar-menu">
        </ul>
    </aside>