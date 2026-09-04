<?php
// controllers/CustomerController.php
// Handles customer operations like placing a new laundry order

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/OrderModel.php';

function placeCustomerOrder($username, $postData) {
    global $conn;

    $phone = trim($postData['phone'] ?? '');
    $address = trim($postData['address'] ?? '');
    $pickupDate = trim($postData['pickup_date'] ?? '');
    $timeSlot = trim($postData['time_slot'] ?? '');
    $itemsJson = $postData['items_json'] ?? '[]';
    $items = json_decode($itemsJson, true);

    if (empty($phone) || empty($address) || empty($pickupDate) || empty($timeSlot)) {
        return ['status' => false, 'message' => 'Please fill in all address, phone, and pickup schedule details.'];
    }

    if (empty($items) || count($items) === 0) {
        return ['status' => false, 'message' => 'Please select quantity for at least one item.'];
    }

    // Build human-readable items summary string (e.g. "2x Shirt (Wash & Iron), 1x Jeans (Dry Cleaning)")
    $subtotal = 0;
    $summaryList = [];

    foreach ($items as $item) {
        $rowTotal = $item['price'] * $item['qty'];
        $subtotal += $rowTotal;
        $summaryList[] = $item['qty'] . 'x ' . $item['name'] . ' (' . $item['service'] . ')';
    }

    $pickupFee = $subtotal >= 30 ? 0.00 : 2.50;
    $tax = $subtotal * 0.08;
    $totalPrice = $subtotal + $pickupFee + $tax;
    $itemsSummary = implode(', ', $summaryList);

    // Save order into MySQL database using Model
    $isSaved = saveOrder($conn, $username, $phone, $itemsSummary, $pickupDate, $timeSlot, $address, $totalPrice);

    if ($isSaved) {
        return ['status' => true, 'message' => 'Order placed successfully and saved into database!'];
    } else {
        return ['status' => false, 'message' => 'Error saving order to database. Please try again.'];
    }
}
?>
