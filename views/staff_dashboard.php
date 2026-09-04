<?php
session_start();

// Redirect to login if user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$username = $_SESSION['username'];
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'Staff';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard | Smart Laundry</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

 <!-- Main Dashboard Flex Layout -->
    <div class="dashboard-wrapper">
        
        <!-- Left Sidebar Navigation -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2><i class="fa-solid fa-soap"></i> Smart Laundry</h2>
                <small>Staff Portal</small>
            </div>

            <ul class="sidebar-menu">
                <li>
                    <a href="../index.php">
                        <i class="fa-solid fa-house"></i> Home Page
                    </a>
                </li>
                <li>
                    <a href="staff_dashboard.php" class="active">
                        <i class="fa-solid fa-boxes-packing"></i> Process Orders
                    </a>
                </li>
                <li>
                    <a href="../logout.php" class="logout-link">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </a>
                </li>
            </ul>

            <div class="sidebar-user-box">
                <span class="user-icon"><i class="fa-solid fa-user-gear"></i></span>
                <div>
                    <strong><?php echo htmlspecialchars($username); ?></strong>
                    <small style="display: block; color: #94a3b8;">Staff Member</small>
                </div>
            </div>
        </aside>