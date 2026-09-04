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
<body>

    <!-- Navigation Bar -->
    <header class="navbar">
        <a href="index.php" class="logo">
            <span class="logo-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2b7a78" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="3" ry="3"/>
                    <circle cx="12" cy="13" r="5"/>
                    <path d="M12 10.5a2.5 2.5 0 0 1 2.5 2.5"/>
                    <circle cx="7" cy="6.5" r="0.8" fill="#2b7a78"/>
                    <circle cx="10" cy="6.5" r="0.8" fill="#2b7a78"/>
                </svg>
            </span>
            <span>Smart Laundry</span>
        </a>

        <!-- Center Links -->
        <nav class="nav-center">
            <a href="index.php">Home</a>
            <a href="about.php">About Us</a>
            <a href="contact.php">Contact Us</a>
        </nav>

        <!-- Right Auth Links -->
        <div class="nav-right">
            <a href="login.php" class="nav-link active" style="color: #2b7a78; font-weight: bold;">Login</a>
            <a href="register.php" class="btn-sm">Register</a>
        </div>
    </header>

    <!-- Login Container -->
    <section style="max-width: 440px; margin: 60px auto; padding: 0 20px;">
        <div style="background: #ffffff; padding: 35px 30px; border-radius: 8px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); border: 1px solid #e2e8f0; text-align: center;">
            <h2 style="color: #17252a; margin-bottom: 8px;">User Login</h2>
            <p style="color: #64748b; font-size: 14px; margin-bottom: 25px;">Sign in to your Smart Laundry account</p>

            <?php if (!empty($error)): ?>
                <p style="color:red; background-color: #fee2e2; padding: 10px; border-radius: 6px; font-size: 14px; margin-bottom: 15px;"><?php echo $error; ?></p>
            <?php endif; ?>

            <form method="post" action="" style="text-align: left;">
                <div style="margin-bottom: 18px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #334155; font-size: 14px;">Username or Email</label>
                    <input type="text" name="username" placeholder="Username or Email" value="<?php echo isset($_COOKIE['username']) ? $_COOKIE['username'] : $user; ?>" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;" required>
                </div>

                <div style="margin-bottom: 18px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #334155; font-size: 14px;">Login As (Select Role)</label>
                    <select name="role" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; background-color: #ffffff;" required>
                        <option value="Customer" <?php if ($role == "Customer") echo "selected"; ?>>Customer</option>
                        <option value="Staff" <?php if ($role == "Staff") echo "selected"; ?>>Staff</option>
                        <option value="Admin" <?php if ($role == "Admin") echo "selected"; ?>>Admin</option>
                        <option value="Owner" <?php if ($role == "Owner") echo "selected"; ?>>Owner</option>
                    </select>
                </div>
                <div style="margin-bottom: 18px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #334155; font-size: 14px;">Password</label>
                    <input type="password" name="password" placeholder="Password" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;" required>
                </div>

                <div style="margin-bottom: 25px;">
                    <label style="font-size: 14px; color: #334155; cursor: pointer;">
                        <input type="checkbox" name="remember" style="margin-right: 6px;"> Remember Me
                    </label>
                </div>

                <input type="submit" value="Login" class="btn" style="width: 100%; text-align: center; border: none; cursor: pointer; padding: 12px; font-size: 15px;">
            </form>

            <div style="margin-top: 20px; padding-top: 15px; border-top: 1px solid #f1f5f9; font-size: 14px; color: #64748b;">
                Don't have an account? <a href="register.php" style="color: #2b7a78; font-weight: bold; text-decoration: none;">New User / Register</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; <?php echo date("Y"); ?> Smart Laundry. All rights reserved.</p>
    </footer>

    <!-- JS Script -->
    <script src="assets/js/script.js"></script>
</body>
</html>

