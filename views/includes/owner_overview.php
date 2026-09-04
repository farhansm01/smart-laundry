<!-- OWNER OVERVIEW & SERVICE PRICING COMPONENT -->
<?php
require_once __DIR__ . '/../../controllers/OwnerController.php';

// Handle POST actions for services
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['service_action'])) {
    $service_result = handleOwnerServiceAction($_POST);
    if ($service_result['status']) {
        $success_msg = $service_result['message'];
    } else {
        $error_msg = $service_result['message'];
    }
}

$data = fetchOwnerOverview();
$all_orders = $data['orders'];
$services = fetchServices();
?>

<section id="owner-overview" class="dashboard-section">
    <div class="section-title-box">
        <h2><i class="fa-solid fa-chart-line"></i> Business Performance & Service Pricing</h2>
        <p>Monitor revenue, orders, and laundry service pricing in real time.</p>
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

    <!-- Metric Stat Cards Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
        <div style="background: #ffffff; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05); text-align: center;">
            <div style="font-size: 28px; color: #2b7a78; margin-bottom: 6px;"><i class="fa-solid fa-dollar-sign"></i></div>
            <div style="font-size: 24px; font-weight: bold; color: #1e293b;">$<?php echo number_format($data['total_revenue'], 2); ?></div>
            <div style="font-size: 13px; color: #64748b; margin-top: 4px;">Total Business Revenue</div>
        </div>

        <div style="background: #ffffff; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05); text-align: center;">
            <div style="font-size: 28px; color: #0284c7; margin-bottom: 6px;"><i class="fa-solid fa-boxes-stacked"></i></div>
            <div style="font-size: 24px; font-weight: bold; color: #1e293b;"><?php echo $data['total_orders']; ?></div>
            <div style="font-size: 13px; color: #64748b; margin-top: 4px;">Total Orders Placed</div>
        </div>

        <div style="background: #ffffff; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05); text-align: center;">
            <div style="font-size: 28px; color: #d97706; margin-bottom: 6px;"><i class="fa-solid fa-clock-rotate-left"></i></div>
            <div style="font-size: 24px; font-weight: bold; color: #1e293b;"><?php echo $data['pending_count']; ?></div>
            <div style="font-size: 13px; color: #64748b; margin-top: 4px;">Pending Orders</div>
        </div>

        <div style="background: #ffffff; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05); text-align: center;">
            <div style="font-size: 28px; color: #16a34a; margin-bottom: 6px;"><i class="fa-solid fa-circle-check"></i></div>
            <div style="font-size: 24px; font-weight: bold; color: #1e293b;"><?php echo $data['completed_count']; ?></div>
            <div style="font-size: 13px; color: #64748b; margin-top: 4px;">Completed / Delivered</div>
        </div>
    </div>

    <!-- OWNER FEATURE: MANAGE SERVICES & PRICING -->
    <div class="orders-card" style="margin-bottom: 30px;">
        <h3 style="font-size: 16px; margin-bottom: 15px; color: #1e293b;"><i class="fa-solid fa-tags"></i> Manage Laundry Services & Unit Pricing</h3>
        
        <table class="orders-table" style="margin-bottom: 25px;">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Service Type</th>
                    <th>Current Price ($)</th>
                    <th style="width: 200px; text-align: center;">Update Unit Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $srv): ?>
                    <tr>
                        <td>
                            <i class="fa-solid <?php echo htmlspecialchars($srv['icon']); ?>" style="color: #2b7a78; margin-right: 6px;"></i>
                            <strong><?php echo htmlspecialchars($srv['item_name']); ?></strong>
                        </td>
                        <td><span class="item-tag"><?php echo htmlspecialchars($srv['service_type']); ?></span></td>
                        <td><strong style="color: #16a34a;">$<?php echo number_format($srv['price'], 2); ?></strong></td>
                        <td style="text-align: center;">
                            <form method="POST" action="" style="display: flex; gap: 4px; justify-content: center;">
                                <input type="hidden" name="service_action" value="update_price">
                                <input type="hidden" name="service_id" value="<?php echo $srv['id']; ?>">
                                <input type="number" step="0.50" min="0.50" name="price" value="<?php echo $srv['price']; ?>" style="width: 80px; padding: 4px; border: 1px solid #cbd5e1; border-radius: 4px; font-size: 12px;">
                                <button type="submit" class="btn-sm" style="background-color: #2b7a78; color: #fff; border: none; padding: 4px 8px; font-size: 11px; border-radius: 4px; cursor: pointer;">
                                    Save Price
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Form: Add New Service -->
        <div style="background: #f8fafc; padding: 15px; border-radius: 6px; border: 1px solid #e2e8f0;">
            <h4 style="font-size: 14px; margin-bottom: 10px; color: #334155;"><i class="fa-solid fa-plus-circle"></i> Add New Laundry Service Item</h4>
            <form method="POST" action="" style="display: grid; grid-template-columns: 2fr 2fr 1fr 1fr 1fr; gap: 10px; align-items: end;">
                <input type="hidden" name="service_action" value="add">
                <div>
                    <label style="font-size: 11px; display: block; font-weight: bold;">Clothes/Item Name</label>
                    <input type="text" name="item_name" placeholder="e.g. Jacket / Coat" required style="width: 100%; padding: 6px; font-size: 12px; border: 1px solid #cbd5e1; border-radius: 4px;">
                </div>
                <div>
                    <label style="font-size: 11px; display: block; font-weight: bold;">Service Type</label>
                    <input type="text" name="service_type" placeholder="e.g. Leather Care" required style="width: 100%; padding: 6px; font-size: 12px; border: 1px solid #cbd5e1; border-radius: 4px;">
                </div>
                <div>
                    <label style="font-size: 11px; display: block; font-weight: bold;">Price ($)</label>
                    <input type="number" step="0.50" min="0.50" name="price" placeholder="9.50" required style="width: 100%; padding: 6px; font-size: 12px; border: 1px solid #cbd5e1; border-radius: 4px;">
                </div>
                <div>
                    <label style="font-size: 11px; display: block; font-weight: bold;">Icon</label>
                    <select name="icon" style="width: 100%; padding: 6px; font-size: 12px; border: 1px solid #cbd5e1; border-radius: 4px;">
                        <option value="fa-shirt">Shirt</option>
                        <option value="fa-socks">Socks/Pants</option>
                        <option value="fa-user-tie">Tie/Suit</option>
                        <option value="fa-box">Box</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn-sm" style="width: 100%; background-color: #0284c7; color: #fff; border: none; padding: 7px; font-size: 12px; border-radius: 4px; cursor: pointer;">
                        + Add Service
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Orders Master List -->
    <div class="orders-card">
        <h3 style="font-size: 16px; margin-bottom: 15px; color: #1e293b;"><i class="fa-solid fa-receipt"></i> Master Transactions & Order Logs</h3>
        <?php if (empty($all_orders)): ?>
            <div style="text-align: center; padding: 30px; color: #64748b;">
                <p>No orders registered in system yet.</p>
            </div>
        <?php else: ?>
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Selected Services</th>
                        <th>Total Amount</th>
                        <th>Current State</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($all_orders as $ord): 
                        $status_raw = strtolower(str_replace(' ', '', $ord['status']));
                        $badge_class = 'badge-pending';
                        if (strpos($status_raw, 'accepted') !== false) $badge_class = 'badge-accepted';
                        elseif (strpos($status_raw, 'completed') !== false || strpos($status_raw, 'delivered') !== false) $badge_class = 'badge-completed';
                        elseif (strpos($status_raw, 'cancelled') !== false) $badge_class = 'badge-cancelled';
                        elseif (strpos($status_raw, 'assigned') !== false) $badge_class = 'badge-assigned';
                    ?>
                        <tr>
                            <td><strong style="color: #2b7a78;">#ORD-<?php echo htmlspecialchars($ord['id']); ?></strong></td>
                            <td><strong><?php echo htmlspecialchars($ord['customer_name']); ?></strong></td>
                            <td><?php echo htmlspecialchars($ord['customer_phone']); ?></td>
                            <td><span class="item-tag" style="font-size: 12px;"><?php echo htmlspecialchars($ord['items_summary']); ?></span></td>
                            <td><strong>$<?php echo number_format($ord['total_price'], 2); ?></strong></td>
                            <td>
                                <span class="badge-status <?php echo $badge_class; ?>">
                                    <?php echo htmlspecialchars($ord['status']); ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</section>
