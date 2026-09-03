<?php
session_start();

// Redirect to login if user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard | Smart Laundry</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

    <div style="padding: 40px; text-align: center;">
        <h1>Hello, this is Customer Dashboard</h1>
        <p>Logged in as: <strong><?php echo htmlspecialchars($username); ?></strong></p>
        <a href="../logout.php" class="btn" style="display: inline-block; margin-top: 20px;">Logout</a>
    </div>

</body>
</html>
