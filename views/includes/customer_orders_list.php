<!-- SECTION 2: MY ORDERS LIST COMPONENT -->
<?php
require_once __DIR__ . '/../../controllers/CustomerController.php';
$user_orders = fetchCustomerOrders($username);
?>
<section id="my-orders" class="dashboard-section">
    <div class="section-title-box">
        <h2><i class="fa-solid fa-box-archive"></i> My Orders History</h2>
        <p>Track your placed orders and live state updates.</p>
    </div>

    <div class="orders-card">
        <?php if (empty($user_orders)): ?>
            <div style="text-align: center; padding: 30px; color: #64748b;">
                <i class="fa-solid fa-box-open" style="font-size: 36px; margin-bottom: 10px; color: #cbd5e1; display: block;"></i>
                <p style="font-size: 15px; margin-bottom: 15px;">No orders placed yet!</p>
                <a href="customer_dashboard.php?view=press_order" class="btn" style="padding: 10px 20px; font-size: 14px;">
                    <i class="fa-solid fa-circle-plus"></i> Press Your First Order
                </a>
            </div>
        <?php else: ?>
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Pickup Schedule</th>
                        <th>Selected Clothes & Services</th>
                        <th>Delivery Address</th>
                        <th>Total Price</th>
                        <th>Current State</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($user_orders as $ord): 
                        $status_text = htmlspecialchars($ord['status']);
                        $status_code = strtolower(str_replace(' ', '', $ord['status']));
                    ?>
                        <tr>
                            <td><strong style="color: #2b7a78;">#ORD-<?php echo htmlspecialchars($ord['id']); ?></strong></td>
                            <td>
                                <div>📅 <?php echo htmlspecialchars($ord['pickup_date']); ?></div>
                                <small style="color: #64748b;">⏰ <?php echo htmlspecialchars($ord['pickup_slot']); ?></small>
                            </td>
                            <td>
                                <span class="item-tag" style="display: block; font-size: 13px; line-height: 1.5;">
                                    <?php echo htmlspecialchars($ord['items_summary']); ?>
                                </span>
                            </td>
                            <td>
                                <small style="color: #475569;"><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($ord['delivery_address']); ?></small>
                            </td>
                            <td><strong>$<?php echo number_format($ord['total_price'], 2); ?></strong></td>
                            <td>
                                <span class="badge-status badge-<?php echo $status_code; ?>">
                                    ⏳ <?php echo $status_text; ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</section>
