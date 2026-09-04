<?php
// models/ServiceModel.php
// Manages laundry service items and unit prices in MySQL database

// Function 1: Ensure services table exists and seed initial default items
function createServicesTableIfNotExists($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS services (
        id INT AUTO_INCREMENT PRIMARY KEY,
        item_name VARCHAR(100) NOT NULL,
        service_type VARCHAR(100) NOT NULL,
        price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
        icon VARCHAR(50) DEFAULT 'fa-shirt'
    )";
    $conn->query($sql);

    // Seed default items if table is empty
    $checkSql = "SELECT COUNT(*) as cnt FROM services";
    $res = $conn->query($checkSql);
    if ($res) {
        $row = $res->fetch_assoc();
        if (intval($row['cnt']) === 0) {
            $seedSql = "INSERT INTO services (item_name, service_type, price, icon) VALUES
                ('Shirt / T-Shirt', 'Wash & Iron', 3.50, 'fa-shirt'),
                ('Trousers / Jeans', 'Wash & Fold', 4.50, 'fa-socks'),
                ('Dress / Skirt', 'Dry Cleaning', 7.00, 'fa-person-dress'),
                ('Suit / Blazer', 'Steam Clean', 12.00, 'fa-user-tie'),
                ('Bed Sheet / Linen', 'Deep Clean', 6.50, 'fa-bed'),
                ('Heavy Comforter', 'Heavy Duty Wash', 14.00, 'fa-box')";
            $conn->query($seedSql);
        }
    }
}

// Function 2: Get all laundry services & prices
function getAllServices($conn) {
    createServicesTableIfNotExists($conn);
    $sql = "SELECT * FROM services ORDER BY id ASC";
    $result = $conn->query($sql);
    $services = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $services[] = $row;
        }
    }
    return $services;
}

// Function 3: Add new laundry service
function addService($conn, $itemName, $serviceType, $price, $icon = 'fa-shirt') {
    createServicesTableIfNotExists($conn);
    $sql = "INSERT INTO services (item_name, service_type, price, icon) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssds", $itemName, $serviceType, $price, $icon);
        $res = $stmt->execute();
        $stmt->close();
        return $res;
    }
    return false;
}

// Function 4: Update price of an existing service
function updateServicePrice($conn, $serviceId, $price) {
    createServicesTableIfNotExists($conn);
    $sql = "UPDATE services SET price = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("di", $price, $serviceId);
        $res = $stmt->execute();
        $stmt->close();
        return $res;
    }
    return false;
}
?>
