<!-- ADMIN ORDERS LIST COMPONENT -->
<?php
require_once __DIR__ . '/../../controllers/AdminController.php';

// Handle action submit if POSTed
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_action'])) {
    $action_result = handleAdminOrderAction($_POST);
    if ($action_result['status']) {
        $success_msg = $action_result['message'];
    } else {
        $error_msg = $action_result['message'];
    }
}

// Fetch all orders & registered staff members
$all_orders = fetchAllOrders();
$staff_members = fetchStaffMembers();
?>

<section id="admin-orders" class="dashboard-section">
    <div class="section-title-box">
        <h2><i class="fa-solid fa-user-shield"></i> All Customer Orders (Admin View)</h2>
        <p>Review customer laundry bookings, accept or reject orders, and assign orders to staff.</p>
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
        <?php if (empty($all_orders)): ?>
            <div style="text-align: center; padding: 40px; color: #64748b;">
                <i class="fa-solid fa-box-open" style="font-size: 40px; margin-bottom: 12px; color: #cbd5e1; display: block;"></i>
                <p style="font-size: 16px;">No customer orders found in the database.</p>
            </div>
        <?php else: ?>
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Info</th>
                        <th>Items & Services</th>
                        <th>Pickup & Address</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th style="width: 250px; text-align: center;">Admin Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($all_orders as $ord): 
                        $status_raw = $ord['status'];
                        $badge_class = 'badge-pending';
                        if (strpos(strtolower($status_raw), 'accepted') !== false) $badge_class = 'badge-accepted';
                        elseif (strpos(strtolower($status_raw), 'cancelled') !== false) $badge_class = 'badge-cancelled';
                        elseif (strpos(strtolower($status_raw), 'assigned') !== false) $badge_class = 'badge-assigned';
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
                            <td>
                                <div>📅 <?php echo htmlspecialchars($ord['pickup_date']); ?> (<?php echo htmlspecialchars($ord['pickup_slot']); ?>)</div>
                                <small style="color: #475569;"><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($ord['delivery_address']); ?></small>
                            </td>
                            <td><strong>$<?php echo number_format($ord['total_price'], 2); ?></strong></td>
                            <td>
                                <span class="badge-status <?php echo $badge_class; ?>">
                                    <?php echo htmlspecialchars($ord['status']); ?>
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <!-- Accept / Reject buttons -->
                                <div style="display: flex; gap: 6px; justify-content: center; margin-bottom: 8px;">
                                    <form method="POST" action="" style="display: inline;">
                                        <input type="hidden" name="admin_action" value="1">
                                        <input type="hidden" name="order_id" value="<?php echo $ord['id']; ?>">
                                        <input type="hidden" name="action" value="accept">
                                        <button type="submit" title="Click to accept this order" class="btn-sm" style="background-color: #16a34a; color: #fff; padding: 4px 8px; font-size: 11px; border: none; cursor: pointer; border-radius: 4px;">
                                            <i class="fa-solid fa-check"></i> Accept
                                        </button>
                                    </form>

                                    <form method="POST" action="" style="display: inline;">
                                        <input type="hidden" name="admin_action" value="1">
                                        <input type="hidden" name="order_id" value="<?php echo $ord['id']; ?>">
                                        <input type="hidden" name="action" value="reject">
                                        <button type="submit" title="Click to reject this order" class="btn-sm" style="background-color: #dc2626; color: #fff; padding: 4px 8px; font-size: 11px; border: none; cursor: pointer; border-radius: 4px;">
                                            <i class="fa-solid fa-xmark"></i> Reject
                                        </button>
                                    </form>
                                </div>

                                <!-- Assign to Staff Form (Dynamic from database) -->
                                <form method="POST" action="" style="display: flex; gap: 4px;">
                                    <input type="hidden" name="admin_action" value="1">
                                    <input type="hidden" name="order_id" value="<?php echo $ord['id']; ?>">
                                    <input type="hidden" name="action" value="assign">
                                    <select name="staff_name" style="padding: 4px; font-size: 11px; border: 1px solid #cbd5e1; border-radius: 4px; flex: 1;">
                                        <?php if (empty($staff_members)): ?>
                                            <option value="">No Staff Registered</option>
                                        <?php else: ?>
                                            <?php foreach ($staff_members as $st_user): ?>
                                                <option value="<?php echo htmlspecialchars($st_user); ?>">
                                                    Staff: <?php echo htmlspecialchars($st_user); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                    <button type="submit" class="btn-sm" style="background-color: #0284c7; color: #fff; padding: 4px 8px; font-size: 11px; border: none; cursor: pointer; border-radius: 4px;" <?php if (empty($staff_members)) echo 'disabled'; ?>>
                                        Assign
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</section>