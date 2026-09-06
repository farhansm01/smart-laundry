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
                <small>Owner Portal</small>
            </div>

            <ul class="sidebar-menu">
                <li>
                    <a href="../index.php">
                        <i class="fa-solid fa-house"></i> Home Page
                    </a>
                </li>
                <li>
                    <a href="owner_dashboard.php" class="active">
                        <i class="fa-solid fa-chart-pie"></i> Business Overview
                    </a>
                </li>
                <li>
                    <a href="../logout.php" class="logout-link">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </a>
                </li>
            </ul>

            <div class="sidebar-user-box">
                <span class="user-icon"><i class="fa-solid fa-crown"></i></span>
                <div>
                    <strong><?php echo htmlspecialchars($username); ?></strong>
                    <small style="display: block; color: #94a3b8;">Business Owner</small>
                </div>
            </div>
        </aside>

        <!-- Right Content Area -->
        <main class="dashboard-main">
            <!-- Title Header Card -->
            <div class="dashboard-header">
                <h1>Owner Dashboard</h1>
                <p>Welcome back, <strong><?php echo htmlspecialchars($username); ?></strong>! Monitor store revenue, order volume, and business growth.</p>
            </div>

            <!-- Dashboard Content Container -->
            <div class="dashboard-content">
                
                <?php include __DIR__ . "/includes/owner_overview.php"; ?>

            </div>

            <!-- Footer -->
            <footer class="footer">
                <p>&copy; <?php echo date("Y"); ?> Smart Laundry. All rights reserved.</p>
            </footer>
        </main>

    </div>

</body>
</html>