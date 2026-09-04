<?php

// controllers/OwnerController.php
// Handles business overview statistics, service creation, and price settings for the laundry business owner

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/OrderModel.php';
require_once __DIR__ . '/../models/ServiceModel.php';

function fetchOwnerOverview()
{
    global $conn;

    $orders = getAllOrders($conn);

    // Fetch all orders for owner dashboard statistics
$orders = getAllOrders($conn);
    $totalOrders = count($orders); // Calculate total number of orders
    $pendingCount = 0;
    $completedCount = 0;

    foreach ($orders as $ord) {
        $totalRevenue += floatval($ord['total_price']);
        $status = strtolower($ord['status']);

        if (strpos($status, 'pending') !== false) {
            $pendingCount++;
        } elseif (
            strpos($status, 'completed') !== false ||
            strpos($status, 'delivered') !== false
        ) {
            $completedCount++;
        }
    }

    return [
        'total_orders' => $totalOrders,
        'total_revenue' => $totalRevenue,
        'pending_count' => $pendingCount,
        'completed_count' => $completedCount,
        'orders' => $orders
    ];
}

// Fetch list of services & prices
function fetchServices()
{
    global $conn;

    return getAllServices($conn);
}

// Process owner service actions
// (Add new service or Update price)
function handleOwnerServiceAction($postData)
{
    global $conn;

    $action = isset($postData['service_action'])
        ? trim($postData['service_action'])
        : '';

    if ($action === 'add') {

        $itemName = trim($postData['item_name'] ?? '');
        $serviceType = trim($postData['service_type'] ?? '');
        $price = floatval($postData['price'] ?? 0);
        $icon = trim($postData['icon'] ?? 'fa-shirt');

        if (
            empty($itemName) ||
            empty($serviceType) ||
            $price <= 0
        ) {
            return [
                'status' => false,
                'message' => 'Please enter valid service name, type, and price.'
            ];
        }

        $res = addService(
            $conn,
            $itemName,
            $serviceType,
            $price,
            $icon
        );

        if ($res) {
            return [
                'status' => true,
                'message' => "New service '{$itemName}' added with price \${$price}!"
            ];
        }

    } elseif ($action === 'update_price') {

        $serviceId = intval($postData['service_id'] ?? 0);
        $price = floatval($postData['price'] ?? 0);

        if ($serviceId <= 0 || $price <= 0) {
            return [
                'status' => false,
                'message' => 'Invalid service price update.'
            ];
        }

        $res = updateServicePrice(
            $conn,
            $serviceId,
            $price
        );

        if ($res) {
            return [
                'status' => true,
                'message' => "Service price updated to \${$price}!"
            ];
        }
    }

    return [
        'status' => false,
        'message' => 'Failed to save service changes.'
    ];
}

?>