<!-- STAFF ORDERS LIST COMPONENT -->
<?php
require_once __DIR__ . '/../../controllers/StaffController.php';

// Handle status update POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_staff_status'])) {
    $result = handleStaffStatusUpdate($_POST);
    if ($result['status']) {
        $success_msg = $result['message'];
    } else {
        $error_msg = $result['message'];
    }
}

// Fetch orders assigned specifically to the logged-in staff member ($username)
$staff_orders = fetchStaffOrders($username);
?>

<section id="staff-orders" class="dashboard-section">
    <div class="section-title-box">
        <h2><i class="fa-solid fa-list-check"></i> My Assigned Orders (Staff: <?php echo htmlspecialchars($username); ?>)</h2>
        <p>Manage and process laundry orders assigned to you by the administrator.</p>
    </div>

    <?php if (!empty($success_msg)): ?>
        <div class="alert-box alert-success" style="margin-bottom: 20px;">
            <i class="fa-solid fa-circle-check"></i> <?php echo $success_msg; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($error_msg)): ?>
        <div class="alert-box alert-error" style="margin-bottom: 20px;">
            <i class="fa-solid fa-triangle-exclamation"></i> <?php echo $error_msg; ?>
        </div>
    <?php endif; ?>

    <div class="orders-card">
        <?php if (empty($staff_orders)): ?>
            <div style="text-align: center; padding: 40px; color: #64748b;">
                <i class="fa-solid fa-box-open" style="font-size: 40px; margin-bottom: 12px; color: #cbd5e1; display: block;"></i>
                <p style="font-size: 16px; font-weight: bold; margin-bottom: 6px;">No assigned orders yet!</p>
                <p style="font-size: 14px; color: #94a3b8;">When Admin assigns an order to <strong><?php echo htmlspecialchars($username); ?></strong>, it will appear here.</p>
            </div>
             <?php else: ?>
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Info</th>
                        <th>Clothes & Services</th>
                        <th>Pickup & Address</th>
                        <th>Current State</th>
                        <th style="width: 220px; text-align: center;">Update Status</th>
                    </tr>
                </thead>
                <tbody>
            <?php foreach ($staff_orders as $ord): 
                        $status_raw = strtolower(str_replace(' ', '', $ord['status']));
                        $badge_class = 'badge-pending';
                        if (strpos($status_raw, 'accepted') !== false) $badge_class = 'badge-accepted';
                        elseif (strpos($status_raw, 'outforpickup') !== false) $badge_class = 'badge-outforpickup';
                        elseif (strpos($status_raw, 'laundry') !== false || strpos($status_raw, 'processing') !== false) $badge_class = 'badge-processing';
                        elseif (strpos($status_raw, 'completed') !== false || strpos($status_raw, 'delivered') !== false) $badge_class = 'badge-completed';
                        elseif (strpos($status_raw, 'cancelled') !== false) $badge_class = 'badge-cancelled';
                        elseif (strpos($status_raw, 'assigned') !== false) $badge_class = 'badge-assigned';
                    ?>
                    <tr>
                            <td><strong style="color: #2b7a78;">#ORD-<?php echo htmlspecialchars($ord['id']); ?></strong></td>
                            <td>
                                <strong><?php echo htmlspecialchars($ord['customer_name']); ?></strong>
                                <div style="font-size: 12px; color: #64748b;">📞 <?php echo htmlspecialchars($ord['customer_phone']); ?></div>
                            </td>
                            <td>
                                <span class="item-tag" style="display: block; font-size: 13px;">
                                    <?php echo htmlspecialchars($ord['items_summary']); ?>
                                </span>
                            </td>