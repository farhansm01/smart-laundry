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