<?php
include "config/db.php";

$success = $error = "";
$username = $email = $role = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $email = test_input($_POST["email"]);
    $role = test_input($_POST["role"]);

    if (empty($username) || empty($password) || empty($email) || empty($role)) {
        $error = "Please fill all required fields";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    } else {
        $sql = "INSERT INTO registration (username,password,email,role) VALUES ('$username','$password','$email','$role')";

        if ($conn->query($sql) === TRUE) {
            $success = "Registration Done as " . $role . "! You can now login.";
            $username = $email = $role = "";
        } else {
            $error = "Error: " . $conn->error;
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
    <title>Register | Smart Laundry</title>
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
            <a href="login.php" class="nav-link">Login</a>
            <a href="register.php" class="btn-sm">Register</a>
        </div>
    </header>
    <!-- Register Container -->
    <section style="max-width: 480px; margin: 50px auto; padding: 0 20px;">
        <div style="background: #ffffff; padding: 35px 30px; border-radius: 8px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); border: 1px solid #e2e8f0; text-align: center;">
            <h2 style="color: #17252a; margin-bottom: 8px;">User Registration</h2>
            <p style="color: #64748b; font-size: 14px; margin-bottom: 25px;">Sign up for Smart Laundry doorstep service</p>

            <?php if (!empty($success)): ?>
                <p style="color:green; background-color: #dcfce7; padding: 10px; border-radius: 6px; font-size: 14px; margin-bottom: 15px;"><?php echo $success; ?> <a href="login.php" style="color: green; font-weight: bold;">Login Now</a></p>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
                <p style="color:red; background-color: #fee2e2; padding: 10px; border-radius: 6px; font-size: 14px; margin-bottom: 15px;"><?php echo $error; ?></p>
            <?php endif; ?>

            <form method="post" action="" style="text-align: left;">
                <div style="margin-bottom: 18px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #334155; font-size: 14px;">Username</label>
                    <input type="text" name="username" value="<?php echo $username; ?>" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;" placeholder="Enter Username" required>
                </div>

                <div style="margin-bottom: 18px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #334155; font-size: 14px;">Email Address</label>
                    <input type="email" name="email" value="<?php echo $email; ?>" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;" placeholder="Enter Email Address" required>
                </div>

                <div style="margin-bottom: 18px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #334155; font-size: 14px;">Select Role</label>
                    <select name="role" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; background-color: #ffffff;" required>
                        <option value="Customer" <?php if ($role == "Customer") echo "selected"; ?>>Customer</option>
                        <option value="Staff" <?php if ($role == "Staff") echo "selected"; ?>>Staff</option>
                        <option value="Admin" <?php if ($role == "Admin") echo "selected"; ?>>Admin</option>
                        <option value="Owner" <?php if ($role == "Owner") echo "selected"; ?>>Owner</option>
                    </select>
                </div>

                <div style="margin-bottom: 25px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #334155; font-size: 14px;">Password</label>
                    <input type="password" name="password" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;" placeholder="Enter Password" required>
                </div>

                <input type="submit" value="Register" class="btn" style="width: 100%; text-align: center; border: none; cursor: pointer; padding: 12px; font-size: 15px;">
            </form>

            <div style="margin-top: 20px; padding-top: 15px; border-top: 1px solid #f1f5f9; font-size: 14px; color: #64748b;">
                Already have an account? <a href="login.php" style="color: #2b7a78; font-weight: bold; text-decoration: none;">Login here</a>
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






