<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Laundry</title>
    <!-- Separated CSS stylesheet in assets/css/style.css -->
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
            <a href="index.php" class="active">Home</a>
            <a href="about.php">About Us</a>
            <a href="contact.php">Contact Us</a>
        </nav>

        <!-- Right Auth Links -->
        <div class="nav-right">
            <a href="login.php" class="nav-link">Login</a>
            <a href="register.php" class="btn-sm">Register</a>
        </div>
    </header>

    <!-- Hero Banner Section -->
    <section class="hero">
        <div class="hero-container">
            <div class="hero-content">
                <span class="hero-badge">✨ Doorstep Laundry Service</span>
                <h1>Welcome to <span>Smart Laundry</span></h1>
                <p>Book your laundry service online — fast, simple, and reliable doorstep pickup & delivery.</p>
                <div class="hero-buttons">
                    <a href="#services" class="btn">Get Started</a>
                    <a href="#how-it-works" class="btn-outline">How It Works</a>
                </div>
            </div>
            <div class="hero-card">
                <div class="hero-card-icon">🧺</div>
                <h3>Fresh & Clean Garments</h3>
                <p>Schedule home pickup in seconds and pay upon delivery.</p>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services" id="services">
        <h2>Our Services</h2>
        <div class="service-cards">
            <div class="card">
                <h3>Wash & Fold</h3>
                <p>Everyday clothes washed and neatly folded.</p>
            </div>
            <div class="card">
                <h3>Dry Cleaning</h3>
                <p>Delicate fabrics handled with care.</p>
            </div>
            <div class="card">
                <h3>Ironing</h3>
                <p>Crisp, wrinkle-free clothes ready to wear.</p>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works" id="how-it-works">
        <h2>How It Works</h2>
        <div class="steps">
            <div class="step-box">
                <div class="step-num">1</div>
                <h3>Book Online</h3>
                <p>Select your service and pickup schedule.</p>
            </div>
            <div class="step-box">
                <div class="step-num">2</div>
                <h3>Home Pickup</h3>
                <p>We pick up your clothes from your door.</p>
            </div>
            <div class="step-box">
                <div class="step-num">3</div>
                <h3>Clean & Wash</h3>
                <p>We wash, dry, and iron with care.</p>
            </div>
            <div class="step-box">
                <div class="step-num">4</div>
                <h3>Delivery & Pay</h3>
                <p>Delivered to your home — pay on delivery.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; <?php echo date("Y"); ?> Smart Laundry. All rights reserved.</p>
    </footer>

    <!-- Separated JS file in assets/js/script.js -->
    <script src="assets/js/script.js"></script>
</body>
</html>
