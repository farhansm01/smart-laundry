<?php
session_start();

// Redirect to login if user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard | Smart Laundry</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

    <!-- Main Dashboard Flex Layout -->
    <div class="dashboard-wrapper">
        
        <!-- Left Sidebar Navigation -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>🧺 Smart Laundry</h2>
                <small>Customer Portal</small>
            </div>

            <ul class="sidebar-menu">
                <li><a href="#dashboard" class="active">🏠 Dashboard</a></li>
                <li><a href="#press-order">➕ Press Order</a></li>
                <li><a href="#my-orders">📦 My Orders</a></li>
                <li><a href="../logout.php" class="logout-link">🚪 Logout</a></li>
            </ul>

            <div class="sidebar-user-box">
                <span class="user-icon">👤</span>
                <div>
                    <strong><?php echo htmlspecialchars($username); ?></strong>
                    <small style="display: block; color: #94a3b8;">Customer</small>
                </div>
            </div>
        </aside>

        <!-- Right Content Area -->
        <main class="dashboard-main">
            <!-- Title Header Card -->
            <div class="dashboard-header">
                <h1>Customer Dashboard</h1>
                <p>Welcome back, <strong><?php echo htmlspecialchars($username); ?></strong>! Manage your orders and doorstep laundry bookings.</p>
            </div>

            <!-- Dashboard Content Placeholder Container -->
            <div class="dashboard-content">
                <div class="info-card">
                    <h3>👋 Welcome to your Laundry Portal</h3>
                    <p>Select <strong>Press Order</strong> to pick your garments and schedule a doorstep pickup date.</p>
                </div>
            </div>

            <!-- Footer -->
            <footer class="footer">
                <p>&copy; <?php echo date("Y"); ?> Smart Laundry. All rights reserved.</p>
            </footer>
        </main>

    </div>

</body>
</html>
