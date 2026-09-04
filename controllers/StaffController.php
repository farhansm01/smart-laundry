<?php
// controllers/StaffController.php
// Handles staff operations like viewing orders assigned specifically to the logged-in staff member

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/OrderModel.php';

// Fetch ONLY the orders assigned to the logged-in staff member
function fetchStaffOrders($staffUsername) {
    global $conn;
    return getStaffAssignedOrders($conn, $staffUsername);
}

// Process staff status update (e.g. 'Out for Pickup', 'In Laundry', 'Processing', 'Completed', 'Delivered')
function handleStaffStatusUpdate($postData) {
    global $conn;

    $orderId = isset($postData['order_id']) ? intval($postData['order_id']) : 0;
    $newStatus = isset($postData['new_status']) ? trim($postData['new_status']) : '';

    if ($orderId <= 0 || empty($newStatus)) {
        return ['status' => false, 'message' => 'Invalid status update request.'];
    }
