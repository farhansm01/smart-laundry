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
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

    <!-- Main Dashboard Flex Layout -->
    <div class="dashboard-wrapper">
        
        <!-- Left Sidebar Navigation -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2><i class="fa-solid fa-soap"></i> Smart Laundry</h2>
                <small>Customer Portal</small>
            </div>

            <ul class="sidebar-menu">
                <li><a href="#dashboard" class="active"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
                <li><a href="#press-order"><i class="fa-solid fa-circle-plus"></i> Press Order</a></li>
                <li><a href="#my-orders"><i class="fa-solid fa-box-archive"></i> My Orders</a></li>
                <li><a href="../logout.php" class="logout-link"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
            </ul>

            <div class="sidebar-user-box">
                <span class="user-icon"><i class="fa-solid fa-circle-user"></i></span>
                <div>
                    <strong><?php echo htmlspecialchars($username); ?></strong>
                    <small style="display: block; color: #94a3b8;">Customer</small>
                </div>
            </div>
        </aside>

        <!-- Right Content Area -->
        <main class="dashboard-main">
            <!-- Title Header Card -->
            <div class="dashboard-header">
                <h1>Customer Dashboard</h1>
                <p>Welcome back, <strong><?php echo htmlspecialchars($username); ?></strong>! Manage your orders and doorstep laundry bookings.</p>
            </div>

            <!-- Dashboard Content Container -->
            <div class="dashboard-content">
                
                <!-- Section 1: Press Order - Decorated Garments & Item Pricing -->
                <section id="press-order" class="dashboard-section">
                    <div class="section-title-box">
                        <h2><i class="fa-solid fa-shirt"></i> Select Garments & Pricing</h2>
                        <p>Choose your clothes and specify quantities for doorstep pickup.</p>
                    </div>

                    <!-- Decorated Garments Grid -->
                    <div class="items-grid">
                        
                        <!-- Item 1: Shirt -->
                        <div class="item-card">
                            <span class="item-badge-tag tag-popular">Popular</span>
                            <div class="item-icon"><i class="fa-solid fa-shirt"></i></div>
                            <h4 class="item-title">Shirt / T-Shirt</h4>
                            <p class="item-service">Wash & Iron</p>
                            <div class="item-footer">
                                <span class="price-pill">$3.50 <small>/ pc</small></span>
                                <div class="quantity-stepper">
                                    <button type="button" class="step-btn"><i class="fa-solid fa-minus"></i></button>
                                    <span class="qty-val">0</span>
                                    <button type="button" class="step-btn"><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </div>
                        </div>

                        <!-- Item 2: Pants -->
                        <div class="item-card">
                            <div class="item-icon"><i class="fa-solid fa-socks"></i></div>
                            <h4 class="item-title">Trousers / Jeans</h4>
                            <p class="item-service">Wash & Fold</p>
                            <div class="item-footer">
                                <span class="price-pill">$4.50 <small>/ pc</small></span>
                                <div class="quantity-stepper">
                                    <button type="button" class="step-btn"><i class="fa-solid fa-minus"></i></button>
                                    <span class="qty-val">0</span>
                                    <button type="button" class="step-btn"><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </div>
                        </div>

                        <!-- Item 3: Dress -->
                        <div class="item-card">
                            <span class="item-badge-tag tag-delicate">Delicate</span>
                            <div class="item-icon"><i class="fa-solid fa-person-dress"></i></div>
                            <h4 class="item-title">Dress / Skirt</h4>
                            <p class="item-service">Dry Cleaning</p>
                            <div class="item-footer">
                                <span class="price-pill">$7.00 <small>/ pc</small></span>
                                <div class="quantity-stepper">
                                    <button type="button" class="step-btn"><i class="fa-solid fa-minus"></i></button>
                                    <span class="qty-val">0</span>
                                    <button type="button" class="step-btn"><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </div>
                        </div>

                        <!-- Item 4: Suit -->
                        <div class="item-card">
                            <div class="item-icon"><i class="fa-solid fa-user-tie"></i></div>
                            <h4 class="item-title">Suit / Blazer</h4>
                            <p class="item-service">Steam Clean</p>
                            <div class="item-footer">
                                <span class="price-pill">$12.00 <small>/ pc</small></span>
                                <div class="quantity-stepper">
                                    <button type="button" class="step-btn"><i class="fa-solid fa-minus"></i></button>
                                    <span class="qty-val">0</span>
                                    <button type="button" class="step-btn"><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </div>
                        </div>

                        <!-- Item 5: Bed Sheet -->
                        <div class="item-card">
                            <div class="item-icon"><i class="fa-solid fa-bed"></i></div>
                            <h4 class="item-title">Bed Sheet</h4>
                            <p class="item-service">Deep Clean</p>
                            <div class="item-footer">
                                <span class="price-pill">$6.50 <small>/ set</small></span>
                                <div class="quantity-stepper">
                                    <button type="button" class="step-btn"><i class="fa-solid fa-minus"></i></button>
                                    <span class="qty-val">0</span>
                                    <button type="button" class="step-btn"><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </div>
                        </div>

                        <!-- Item 6: Comforter -->
                        <div class="item-card">
                            <span class="item-badge-tag tag-express">Heavy</span>
                            <div class="item-icon"><i class="fa-solid fa-box"></i></div>
                            <h4 class="item-title">Heavy Comforter</h4>
                            <p class="item-service">Heavy Wash</p>
                            <div class="item-footer">
                                <span class="price-pill">$14.00 <small>/ pc</small></span>
                                <div class="quantity-stepper">
                                    <button type="button" class="step-btn"><i class="fa-solid fa-minus"></i></button>
                                    <span class="qty-val">0</span>
                                    <button type="button" class="step-btn"><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>

            </div>

            <!-- Footer -->
            <footer class="footer">
                <p>&copy; <?php echo date("Y"); ?> Smart Laundry. All rights reserved.</p>
            </footer>
        </main>

    </div>

</body>
</html>
