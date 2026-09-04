<?php
// models/OrderModel.php

// Ensure assigned_staff column exists in orders table
function ensureAssignedStaffColumnExists($conn) {
    $checkSql = "SHOW COLUMNS FROM orders LIKE 'assigned_staff'";
    $res = $conn->query($checkSql);
    if ($res && $res->num_rows === 0) {
        $conn->query("ALTER TABLE orders ADD COLUMN assigned_staff VARCHAR(100) DEFAULT NULL");
    }
}

// Save a new order into database
function saveOrder($conn, $customerName, $customerPhone, $itemsSummary, $pickupDate, $pickupSlot, $deliveryAddress, $totalPrice) {
    ensureAssignedStaffColumnExists($conn);
    $sql = "INSERT INTO orders (customer_name, customer_phone, items_summary, pickup_date, pickup_slot, delivery_address, total_price, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, 'Pending')";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssssssd", $customerName, $customerPhone, $itemsSummary, $pickupDate, $pickupSlot, $deliveryAddress, $totalPrice);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    return false;
}

// Fetch all orders for a specific customer from database
function getCustomerOrders($conn, $customerName) {
    ensureAssignedStaffColumnExists($conn);
    $sql = "SELECT * FROM orders WHERE customer_name = ? ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $orders = [];

    if ($stmt) {
        $stmt->bind_param("s", $customerName);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
        $stmt->close();
    }

    return $orders;
}

// Fetch ALL orders for Admin & Owner dashboards
function getAllOrders($conn) {
    ensureAssignedStaffColumnExists($conn);
    $sql = "SELECT * FROM orders ORDER BY id DESC";
    $result = $conn->query($sql);
    $orders = [];

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
    }

    return $orders;
}

// Fetch orders assigned strictly to a specific logged-in staff username
function getStaffAssignedOrders($conn, $staffUsername) {
    ensureAssignedStaffColumnExists($conn);
    $sql = "SELECT * FROM orders WHERE assigned_staff = ? ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $orders = [];

    if ($stmt) {
        $stmt->bind_param("s", $staffUsername);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
        $stmt->close();
    }

    return $orders;
}

// Update order status (e.g. 'Accepted', 'Cancelled', 'Processing', 'Completed')
function updateOrderStatus($conn, $orderId, $status) {
    ensureAssignedStaffColumnExists($conn);
    $sql = "UPDATE orders SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("si", $status, $orderId);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    return false;
}

// Assign order to a specific staff member
function assignOrderToStaff($conn, $orderId, $staffName) {
    ensureAssignedStaffColumnExists($conn);
    $status = "Assigned to " . $staffName;
    $sql = "UPDATE orders SET status = ?, assigned_staff = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssi", $status, $staffName, $orderId);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    return false;
}

// Fetch list of registered staff members from registration table
function getRegisteredStaffUsers($conn) {
    $sql = "SELECT username FROM registration WHERE role = 'Staff' ORDER BY username ASC";
    $result = $conn->query($sql);
    $staffList = [];

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $staffList[] = $row['username'];
        }
    }

    return $staffList;
}
?>
