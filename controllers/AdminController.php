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