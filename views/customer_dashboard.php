<?php
session_start();

// Redirect to login if user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$username = $_SESSION['username'];
$success_msg = "";
$error_msg = "";
$current_view = isset($_GET['view']) ? $_GET['view'] : 'press_order';

// Handle Form POST Submission using Controller
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    require_once __DIR__ . '/../controllers/CustomerController.php';
    $result = placeCustomerOrder($username, $_POST);

    if ($result['status']) {
        $success_msg = "Order placed successfully! Status: <span class='badge-status badge-pending'>Pending</span>. <a href='customer_dashboard.php?view=my_orders' style='color: #15803d; font-weight: bold; text-decoration: underline;'>View Order History &rarr;</a>";
    } else {
        $error_msg = $result['message'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard | Smart Laundry</title>
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
                <small>Customer Portal</small>
            </div>

            <ul class="sidebar-menu">
                <li>
                    <a href="../index.php">
                        <i class="fa-solid fa-house"></i> Home Page
                    </a>
                </li>
                <li>
                    <a href="customer_dashboard.php?view=press_order" class="<?php echo ($current_view === 'press_order') ? 'active' : ''; ?>">
                        <i class="fa-solid fa-circle-plus"></i> Press Order
                    </a>
                </li>
                <li>
                    <a href="customer_dashboard.php?view=my_orders" class="<?php echo ($current_view === 'my_orders') ? 'active' : ''; ?>">
                        <i class="fa-solid fa-box-archive"></i> My Orders
                    </a>
                </li>
                <li>
                    <a href="../logout.php" class="logout-link">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </a>
                </li>
            </ul>

            <div class="sidebar-user-box">
                <span class="user-icon"><i class="fa-solid fa-circle-user"></i></span>
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

            <!-- Dashboard Content Container -->
            <div class="dashboard-content">
                
                <?php if (!empty($success_msg)): ?>
                    <div class="alert-box alert-success">
                        <i class="fa-solid fa-circle-check"></i> <?php echo $success_msg; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($error_msg)): ?>
                    <div class="alert-box alert-error">
                        <i class="fa-solid fa-triangle-exclamation"></i> <?php echo $error_msg; ?>
                    </div>
                <?php endif; ?>

                <!-- DYNAMIC COMPONENT VIEW SWITCHING -->
                <?php 
                if ($current_view === 'my_orders') {
                    include __DIR__ . "/includes/customer_orders_list.php";
                } else {
                    include __DIR__ . "/includes/press_order_form.php";
                }
                ?>

            </div>

            <!-- Footer -->
            <footer class="footer">
                <p>&copy; <?php echo date("Y"); ?> Smart Laundry. All rights reserved.</p>
            </footer>
        </main>

    </div>

    <!-- Form JavaScript for Live Calculation & Merging -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const itemRows = document.querySelectorAll('.form-item-row');
        if (itemRows.length === 0) return;

        const itemsJsonInput = document.getElementById('itemsJsonInput');
        const selectedItemsEl = document.getElementById('summarySelectedItems');
        const subtotalEl = document.getElementById('summarySubtotal');
        const pickupFeeEl = document.getElementById('summaryPickupFee');
        const totalEl = document.getElementById('summaryTotal');

        function recalculate() {
            const selectedItems = [];
            let subtotal = 0;
            let totalCount = 0;

            itemRows.forEach(row => {
                const name = row.getAttribute('data-name');
                const price = parseFloat(row.getAttribute('data-price'));
                const serviceSelect = row.querySelector('.service-select');
                const qtyInput = row.querySelector('.qty-input');
                const subtotalCell = row.querySelector('.row-subtotal');

                const service = serviceSelect.value;
                const qty = parseInt(qtyInput.value) || 0;
                const rowTotal = price * qty;

                subtotalCell.textContent = '$' + rowTotal.toFixed(2);

                if (qty > 0) {
                    selectedItems.push({
                        name: name,
                        service: service,
                        price: price,
                        qty: qty
                    });
                    subtotal += rowTotal;
                    totalCount += qty;
                    row.style.backgroundColor = '#f4fbfb';
                } else {
                    row.style.backgroundColor = 'transparent';
                }
            });

            const pickupFee = subtotal > 0 ? (subtotal >= 30 ? 0.00 : 2.50) : 0.00;
            const tax = subtotal * 0.08;
            const grandTotal = subtotal + pickupFee + tax;

            if (selectedItemsEl) selectedItemsEl.textContent = totalCount + (totalCount === 1 ? ' item' : ' items');
            if (subtotalEl) subtotalEl.textContent = '$' + subtotal.toFixed(2);
            if (pickupFeeEl) pickupFeeEl.textContent = pickupFee === 0 ? 'FREE' : '$' + pickupFee.toFixed(2);
            if (totalEl) totalEl.textContent = '$' + grandTotal.toFixed(2);

            if (itemsJsonInput) itemsJsonInput.value = JSON.stringify(selectedItems);
        }

        itemRows.forEach(row => {
            const qtyInput = row.querySelector('.qty-input');
            const serviceSelect = row.querySelector('.service-select');

            if (qtyInput) {
                qtyInput.addEventListener('input', recalculate);
                qtyInput.addEventListener('change', recalculate);
            }
            if (serviceSelect) {
                serviceSelect.addEventListener('change', recalculate);
            }
        });
    });
    </script>

</body>
</html>
