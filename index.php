<?php
// Smart Laundry - Main Landing Homepage
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Laundry - Professional Laundry & Dry Cleaning</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!-- Header Navigation -->
    <header class="navbar">
        <div class="nav-container">
            <a href="index.php" class="brand-logo">
                <i class="fa-solid fa-soap"></i> Smart<span>Laundry</span>
            </a>
            
            <ul class="nav-menu">
                <li><a href="#home" class="active">Home</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#how-it-works">How It Works</a></li>
                <li><a href="#why-us">Why Choose Us</a></li>
                <li><a href="#reviews">Reviews</a></li>
            </ul>

            <div class="nav-actions">
                <a href="customer/views/login.php" class="btn-nav-login">Login</a>
                <a href="customer/views/register.php" class="btn-nav-register">Register</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container">
        
        <!-- Hero Section -->
        <section class="hero" id="home">
            <div class="hero-content">
                <div class="hero-badge">
                    <i class="fa-solid fa-sparkles"></i> Doorstep Pickup & Fast Delivery
                </div>
                <h1>Fresh, Clean & Fragrant <span>Clothes Everyday</span></h1>
                <p>Smart Laundry brings professional laundry care straight to your doorstep. Schedule a pickup online, and we'll handle the washing, drying, ironing, and delivery!</p>
                <div class="hero-buttons">
                    <a href="#services" class="btn-hero-primary"><i class="fa-solid fa-basket-shopping"></i> Explore Services</a>
                    <a href="#how-it-works" class="btn-hero-secondary">How It Works</a>
                </div>
            </div>

            <div class="hero-card">
                <i class="fa-solid fa-shirt"></i>
                <h2>100% Quality Fabric Care</h2>
                <p>Gentle on clothes, tough on stains. Eco-friendly detergents and sanitized washing machines.</p>
            </div>
        </section>

        <!-- Stats Counter Section -->
        <section class="stats-section">
            <div class="stats-grid">
                <div class="stat-item">
                    <h3>10,000+</h3>
                    <p>Clothes Washed</p>
                </div>
                <div class="stat-item">
                    <h3>2,500+</h3>
                    <p>Happy Customers</p>
                </div>
                <div class="stat-item">
                    <h3>15+</h3>
                    <p>Partner Laundry Shops</p>
                </div>
                <div class="stat-item">
                    <h3>24h</h3>
                    <p>Express Delivery</p>
                </div>
            </div>
        </section>

        <!-- Laundry Services Section -->
        <section class="services-section" id="services">
            <div class="section-title">
                <h2>Our Laundry Services</h2>
                <p>Complete garment care for your everyday clothes and special wear</p>
            </div>

            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fa-solid fa-jug-detergent"></i>
                    </div>
                    <h3>Wash & Fold</h3>
                    <p>Regular clothes washed thoroughly with fabric softeners, dried, and folded neatly.</p>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fa-solid fa-suit-case"></i>
                    </div>
                    <h3>Dry Cleaning</h3>
                    <p>Specialized dry cleaning for expensive suits, dresses, coats, and delicate fabrics.</p>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fa-solid fa-mattress-pillow"></i>
                    </div>
                    <h3>Steam Ironing</h3>
                    <p>Crisp, wrinkle-free steam pressing for formal shirts, suits, and uniforms.</p>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fa-solid fa-truck-fast"></i>
                    </div>
                    <h3>Express 24h Service</h3>
                    <p>Emergency laundry needed? We collect, wash, iron, and return within 24 hours.</p>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section class="services-section" id="how-it-works">
            <div class="section-title">
                <h2>How It Works</h2>
                <p>Getting your laundry done in 3 simple steps</p>
            </div>

            <div class="services-grid">
                <div class="service-card" style="text-align: center;">
                    <div class="service-icon" style="margin: 0 auto 1rem;">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <h3>1. Book Pickup</h3>
                    <p>Select your laundry service and schedule a pickup time.</p>
                </div>

                <div class="service-card" style="text-align: center;">
                    <div class="service-icon" style="margin: 0 auto 1rem;">
                        <i class="fa-solid fa-soap"></i>
                    </div>
                    <h3>2. We Clean & Pack</h3>
                    <p>Your garments are washed, dried, ironed, and hygienically packed.</p>
                </div>

                <div class="service-card" style="text-align: center;">
                    <div class="service-icon" style="margin: 0 auto 1rem;">
                        <i class="fa-solid fa-house-chimney-crack"></i>
                    </div>
                    <h3>3. Clean Delivery</h3>
                    <p>Fresh, crisp clothes delivered back to your doorstep on time.</p>
                </div>
            </div>
        </section>

        <!-- Why Choose Us Section -->
        <section class="services-section" id="why-us">
            <div class="section-title">
                <h2>Why Choose Smart Laundry?</h2>
                <p>We provide the best laundry experience with safety and convenience</p>
            </div>

            <div class="why-us-grid">
                <div class="why-card">
                    <i class="fa-solid fa-leaf"></i>
                    <h3>Eco-Friendly Detergents</h3>
                    <p>We use dermatologically tested, non-toxic eco detergents safe for sensitive skin.</p>
                </div>

                <div class="why-card">
                    <i class="fa-solid fa-shield-heart"></i>
                    <h3>Hygiene & Sanitization</h3>
                    <p>Every load is washed separately in disinfected machines to maintain top hygiene.</p>
                </div>

                <div class="why-card">
                    <i class="fa-solid fa-tags"></i>
                    <h3>Affordable Pricing</h3>
                    <p>Transparent pricing per kg or per garment with no hidden service charges.</p>
                </div>

                <div class="why-card">
                    <i class="fa-solid fa-clock"></i>
                    <h3>On-Time Guaranteed</h3>
                    <p>Real-time order status tracking so you always know when your clothes will arrive.</p>
                </div>
            </div>
        </section>

        <!-- Customer Reviews Section -->
        <section class="services-section" id="reviews">
            <div class="section-title">
                <h2>What Our Customers Say</h2>
                <p>Real feedback from satisfied users</p>
            </div>

            <div class="reviews-grid">
                <div class="review-card">
                    <div class="review-stars">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <p>"Super fast pickup and my suits came back perfectly steam-pressed. Smart Laundry saves me so much time!"</p>
                    <div class="reviewer">
                        <div class="reviewer-avatar">AH</div>
                        <div class="reviewer-info">
                            <h4>Alex Harrison</h4>
                            <span>Regular Customer</span>
                        </div>
                    </div>
                </div>

                <div class="review-card">
                    <div class="review-stars">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <p>"The express 24-hour service was a lifesaver before my business trip. Very fresh smell and folded neatly."</p>
                    <div class="reviewer">
                        <div class="reviewer-avatar">MS</div>
                        <div class="reviewer-info">
                            <h4>Maria Smith</h4>
                            <span>Verified User</span>
                        </div>
                    </div>
                </div>

                <div class="review-card">
                    <div class="review-stars">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <p>"Great experience! The pickup guy was polite and on time. Highly recommend for students and busy professionals."</p>
                    <div class="reviewer">
                        <div class="reviewer-avatar">RK</div>
                        <div class="reviewer-info">
                            <h4>Rahim Khan</h4>
                            <span>University Student</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- Professional Multi-Column Footer -->
    <footer class="footer">
        <div class="footer-container">
            
            <!-- Column 1: Brand Info & Social Links -->
            <div class="footer-col">
                <a href="index.php" class="brand-logo" style="margin-bottom: 1rem;">
                    <i class="fa-solid fa-soap"></i> Smart<span>Laundry</span>
                </a>
                <p>Smart Laundry provides professional, fast, and eco-friendly laundry services with doorstep pickup and delivery.</p>
                <div class="social-icons">
                    <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="#" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            </div>

            <!-- Column 2: Quick Links -->
            <div class="footer-col">
                <h4>Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#services">Our Services</a></li>
                    <li><a href="#how-it-works">How It Works</a></li>
                    <li><a href="#why-us">Why Choose Us</a></li>
                    <li><a href="#reviews">Customer Reviews</a></li>
                </ul>
            </div>

            <!-- Column 3: Laundry Services -->
            <div class="footer-col">
                <h4>Services</h4>
                <ul class="footer-links">
                    <li><a href="#services">Wash & Fold</a></li>
                    <li><a href="#services">Dry Cleaning</a></li>
                    <li><a href="#services">Steam Pressing</a></li>
                    <li><a href="#services">Express 24h Service</a></li>
                    <li><a href="#services">Curtain & Bedding Care</a></li>
                </ul>
            </div>

            <!-- Column 4: Contact & Hours -->
            <div class="footer-col">
                <h4>Contact Us</h4>
                <ul class="contact-info-list">
                    <li><i class="fa-solid fa-location-dot"></i> 123 Laundry Street, City Center</li>
                    <li><i class="fa-solid fa-phone"></i> +1 (800) 555-WASH</li>
                    <li><i class="fa-solid fa-envelope"></i> support@smartlaundry.com</li>
                    <li><i class="fa-solid fa-clock"></i> Mon - Sat: 8:00 AM - 9:00 PM</li>
                </ul>
            </div>

        </div>

        <!-- Footer Bottom Bar -->
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Smart Laundry System. Built for Web Tech Course Project.</p>
            <div class="footer-bottom-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
        </div>
    </footer>

</body>
</html>
