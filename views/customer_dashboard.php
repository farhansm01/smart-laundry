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

// Initialize session orders array if not already set
if (!isset($_SESSION['orders'])) {
    $_SESSION['orders'] = [];
}

// Handle Form POST Submission (Merging items into ONE order)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $pickup_date = trim($_POST['pickup_date'] ?? '');
    $time_slot = trim($_POST['time_slot'] ?? '');
    $items_json = $_POST['items_json'] ?? '[]';
    $items = json_decode($items_json, true);

    if (empty($phone) || empty($address) || empty($pickup_date) || empty($time_slot)) {
        $error_msg = "Please fill in all address, phone, and pickup schedule details.";
    } elseif (empty($items) || count($items) === 0) {
        $error_msg = "Please enter quantity for at least one clothes item.";
    } else {
        $order_code = "ORD-" . rand(1000, 9999);
        $subtotal = 0;
        foreach ($items as $it) {
            $subtotal += ($it['price'] * $it['qty']);
        }
        $pickup_fee = $subtotal >= 30 ? 0.00 : 2.50;
        $tax = $subtotal * 0.08;
        $total_amount = $subtotal + $pickup_fee + $tax;

        $new_order = [
            'id' => $order_code,
            'customer_name' => $username,
            'phone' => $phone,
            'address' => $address,
            'pickup_date' => $pickup_date,
            'time_slot' => $time_slot,
            'items' => $items,
            'subtotal' => $subtotal,
            'pickup_fee' => $pickup_fee,
            'tax' => $tax,
            'total_amount' => $total_amount,
            'status' => 'Pending', // Initial State upon placing order
            'created_at' => date('Y-m-d H:i:s')
        ];

        // Store new order at the top of orders list
        array_unshift($_SESSION['orders'], $new_order);
        $success_msg = "Order <strong>" . $order_code . "</strong> placed successfully! Current State: <span class='badge-status badge-pending'>Pending</span>";
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
                <li><a href="customer_dashboard.php" class="active"><i class="fa-solid fa-circle-plus"></i> Press Order</a></li>
                <li><a href="../logout.php" class="logout-link"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
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

                <!-- PRESS ORDER FORM COMPONENT -->
                <?php include __DIR__ . "/includes/press_order_form.php"; ?>

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

            selectedItemsEl.textContent = totalCount + (totalCount === 1 ? ' item' : ' items');
            subtotalEl.textContent = '$' + subtotal.toFixed(2);
            pickupFeeEl.textContent = pickupFee === 0 ? 'FREE' : '$' + pickupFee.toFixed(2);
            totalEl.textContent = '$' + grandTotal.toFixed(2);

            itemsJsonInput.value = JSON.stringify(selectedItems);
        }

        itemRows.forEach(row => {
            const qtyInput = row.querySelector('.qty-input');
            const serviceSelect = row.querySelector('.service-select');

            qtyInput.addEventListener('input', recalculate);
            qtyInput.addEventListener('change', recalculate);
            serviceSelect.addEventListener('change', recalculate);
        });
    });
    </script>

</body>
</html>
