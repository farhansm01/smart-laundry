<?php
// controllers/AdminController.php
// Handles admin operations like viewing all customer orders, accepting, rejecting, and assigning orders to registered staff

require_once __DIR__ . '/../config/db.php';
  require_once __DIR__ . '/../models/OrderModel.php';
  // Fetch all orders placed by all customers
function fetchAllOrders() {
    global $conn;
  return getAllOrders($conn);
}

  // Fetch list of registered staff members
function fetchStaffMembers() {
   global $conn;
    return getRegisteredStaffUsers($conn);
}
// Process admin action (Accept, Reject/Cancel, or Assign to Staff)
function handleAdminOrderAction($postData) {
   global $conn;

    $orderId = isset($postData['order_id']) ? intval($postData['order_id']) : 0;
  $action = isset($postData['action']) ? trim($postData['action']) : '';
    $staffName = isset($postData['staff_name']) ? trim($postData['staff_name']) : '';

   if ($orderId <= 0 || empty($action)) {
       return ['status' => false, 'message' => 'Invalid order action request.'];
   }

    if ($action === 'accept') {
        $updated = updateOrderStatus($conn, $orderId, 'Accepted');
       if ($updated) return ['status' => true, 'message' => "Order #ORD-{$orderId} status updated to 'Accepted'!"];
    } elseif ($action === 'reject') {
       $updated = updateOrderStatus($conn, $orderId, 'Cancelled');
        if ($updated) return ['status' => true, 'message' => "Order #ORD-{$orderId} status updated to 'Cancelled'!"];
   } elseif ($action === 'assign') {
       if (empty($staffName)) {
            return ['status' => false, 'message' => 'Please select a registered staff member to assign.'];
       }
        $updated = assignOrderToStaff($conn, $orderId, $staffName);
        if ($updated) return ['status' => true, 'message' => "Order #ORD-{$orderId} assigned to Staff '{$staffName}'!"];
    }

   return ['status' => false, 'message' => 'Failed to update order status. Please try again.'];
}
?>