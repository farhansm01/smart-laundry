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
?>
