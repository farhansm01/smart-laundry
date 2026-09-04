<!-- STAFF ORDERS LIST COMPONENT -->
<?php
require_once __DIR__ . '/../../controllers/StaffController.php';

// Handle status update POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_staff_status'])) {
    $result = handleStaffStatusUpdate($_POST);
    if ($result['status']) {
        $success_msg = $result['message'];
    } else {
        $error_msg = $result['message'];
    }
}