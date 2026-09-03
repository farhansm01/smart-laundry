<!-- SECTION 2: MY ORDERS LIST COMPONENT -->
<section id="my-orders" class="dashboard-section">
    <div class="section-title-box">
        <h2><i class="fa-solid fa-box-archive"></i> My Orders History</h2>
        <p>Track your placed orders and live state updates.</p>
    </div>

    <div class="orders-card">
        <?php 
        $user_orders = array_filter($_SESSION['orders'] ?? [], function($o) use ($username) {
            return ($o['customer_name'] ?? '') === $username;
        });
        ?>

        <?php if (count($user_orders) === 0): ?>
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
                            <td><strong style="color: #2b7a78;"><?php echo htmlspecialchars($ord['id']); ?></strong></td>
                            <td>
                                <div>📅 <?php echo htmlspecialchars($ord['pickup_date']); ?></div>
                                <small style="color: #64748b;">⏰ <?php echo htmlspecialchars($ord['time_slot']); ?></small>
                            </td>
                            <td>
                                <?php foreach ($ord['items'] as $it): ?>
                                    <span class="item-tag">
                                        <?php echo htmlspecialchars($it['name']); ?> (<?php echo htmlspecialchars($it['service']); ?>) x<strong><?php echo $it['qty']; ?></strong>
                                    </span>
                                <?php endforeach; ?>
                            </td>
                            <td><strong>$<?php echo number_format($ord['total_amount'], 2); ?></strong></td>
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
