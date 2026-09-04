<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Smart Laundry</title>
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
            <a href="contact.php" class="active">Contact Us</a>
        </nav>

        <!-- Right Auth Links -->
        <div class="nav-right">
            <a href="login.php" class="nav-link">Login</a>
            <a href="register.php" class="btn-sm">Register</a>
        </div>
    </header>

    <!-- Page Banner -->
    <section class="hero">
        <div class="hero-container">
            <div class="hero-content">
                <span class="hero-badge">📞 Get In Touch</span>
                <h1>Contact <span>Smart Laundry</span></h1>
                <p>Have questions about our doorstep pickup or services? We're here to help you 7 days a week!</p>
            </div>
            <div class="hero-card">
                <div class="hero-card-icon">💬</div>
                <h3>Quick Support</h3>
                <p>Call or email us anytime for immediate laundry assistance.</p>
            </div>
        </div>
    </section>
    <!-- Contact Form & Info Section -->
    <section class="contact-section" style="max-width: 1000px; margin: 50px auto; padding: 0 20px; display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
        <!-- Contact Information -->
        <div>
            <h2 style="color: #17252a; margin-bottom: 20px;">We'd Love to Hear From You</h2>
            <p style="color: #555; margin-bottom: 30px;">Reach out to us for pickup queries, bulk orders, or support.</p>

            <div style="margin-bottom: 20px;">
                <h4 style="color: #2b7a78; margin-bottom: 5px;">📍 Address</h4>
                <p style="color: #555;">Smart City Hub, Laundry Street, Building 7</p>
            </div>

            <div style="margin-bottom: 20px;">
                <h4 style="color: #2b7a78; margin-bottom: 5px;">📞 Phone & WhatsApp</h4>
                <p style="color: #555;">+1 (800) 555-WASH / +1 (555) 019-2834</p>
            </div>

            <div style="margin-bottom: 20px;">
                <h4 style="color: #2b7a78; margin-bottom: 5px;">✉️ Email</h4>
                <p style="color: #555;">support@smartlaundry.com</p>
            </div>

            <div>
                <h4 style="color: #2b7a78; margin-bottom: 5px;">⏰ Service Hours</h4>
                <p style="color: #555;">Monday – Sunday: 8:00 AM – 9:00 PM</p>
            </div>
        </div>
        <!-- Contact Form -->
        <div style="background: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); border: 1px solid #e2e8f0;">
            <h3 style="color: #17252a; margin-bottom: 20px;">Send Us a Message</h3>

            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                <div style="background-color: #dcfce7; border: 1px solid #86efac; color: #166534; padding: 12px; border-radius: 6px; margin-bottom: 20px; text-align: center;">
                    Thank you! Your message has been sent successfully. We will reply shortly.
                </div>
            <?php endif; ?>

            <form action="contact.php" method="POST">
                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 5px; color: #333;">Your Name</label>
                    <input type="text" name="name" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" placeholder="John Doe" required>
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 5px; color: #333;">Your Email</label>
                    <input type="email" name="email" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" placeholder="john@example.com" required>
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 5px; color: #333;">Subject</label>
                    <input type="text" name="subject" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" placeholder="Pickup Query" required>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 5px; color: #333;">Message</label>
                    <textarea name="message" rows="4" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" placeholder="How can we help you?" required></textarea>
                </div>

                <button type="submit" class="btn" style="width: 100%; text-align: center; border: none; cursor: pointer;">Send Message</button>
            </form>
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