<?php
session_start();
include "config/db.php";

if (isset($_SESSION["username"])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";
$user = $role = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = test_input($_POST["username"]);
    $pass = test_input($_POST["password"]);
    $role = test_input($_POST["role"]);
    $remember = isset($_POST["remember"]);

    if (empty($user) || empty($pass) || empty($role)) {
        $error = "Please fill all required fields";
    } else {
        $sql = "SELECT * FROM registration WHERE (username='$user' OR email='$user') AND password='$pass' AND role='$role'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION["username"] = $row["username"];
            $_SESSION["role"] = $row["role"];

            if ($remember) {
                setcookie("username", $row["username"], time() + (86400 * 30), "/");
            }

            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid username/password or incorrect role selected";
        }
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Smart Laundry</title>
    <!-- CSS Stylesheet -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
