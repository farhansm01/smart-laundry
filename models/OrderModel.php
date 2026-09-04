<?php
// models/OrderModel.php

// Save a new order into database
function saveOrder($conn, $customerName, $customerPhone, $itemsSummary, $pickupDate, $pickupSlot, $deliveryAddress, $totalPrice) {
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
?>
