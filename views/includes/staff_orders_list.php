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