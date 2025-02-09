<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friends used auto parts and mechanical services</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <div class="top-bar">
        <div class="top-bar-links">
            <a href="/blog">Blog</a>
            <a href="/about">About Us</a>
            <a href="/contact">Contact Us</a>
            <a href="/account">My Account</a>
        </div>
    </div>

    <div class="header-wrapper">
        <header class="header">
            <div class="header-content">
                <img src="images/logo.png" height="80" width="80" alt="AutoStore.pk" class="">
                <div class="search-container">
                    <input type="text" placeholder="Search for products..." class="search-input">
                </div>
                <div class="contact-info">
                    <div class="contact-label">Call or WhatsApp</div>
                    <div class="phone-number">0302 2111 406</div>
                </div>
            </div>
        </header>
    </div>

    <nav class="nav">
        <div class="nav-container">
            <a href="/" class="nav-link active">Home</a>
            <a href="/sale" class="nav-link">Sale</a>
            <a href="/brands" class="nav-link">Brands</a>
            <a href="/accessories" class="nav-link">Car Accessories</a>
            <a href="/care" class="nav-link">Car Care</a>
            <a href="/oil" class="nav-link">Oil & Additives</a>
            <a href="/filter" class="nav-link">Car Filter</a>
            <a href="/electronics" class="nav-link">Car Electronics</a>
            <a href="/lights" class="nav-link">LED Lights</a>
            <a href="/parts" class="nav-link">Car Parts</a>
            <a href="/4x4" class="nav-link">4x4 SUV items</a>
            <a href="/others" class="nav-link">Others</a>
        </div>
    </nav>
    

    <section class="hero">
        <div class="hero-container">
            <img src="images/coursel.png" alt="Toyota Revo" class="hero-image">
        </div>

        <div class="nav-arrows">
            <button class="nav-arrow">←</button>
            <button class="nav-arrow">→</button>
        </div>
    </section>

    <!-- Add this after the hero section -->
<section class="search-parts">
    <div class="container">
        <h2>Search Parts For Your Car</h2>
        <div class="search-form">
            <select class="search-select">
                <option>BMW</option>
                <!-- Add more options -->
            </select>
            <select class="search-select">
                <option>--Select Model--</option>
                <!-- Add more options -->
            </select>
            <select class="search-select">
                <option>--Select Year--</option>
                <!-- Add more options -->
            </select>
            <button class="filter-button">Filter</button>
        </div>
    </div>
</section>

<section class="projects">
    <div class="container">
        <h2>AutoStore Projects</h2>
        <p class="projects-description">Check out custom car modifications done by team of experts at AutoStore workshop!<p>
        
        <div class="projects-grid">
            <div class="project-card">
                <div class="before-after">
                    <div class="image-container">
                        <img src="images/btoyota.png" alt="Before">
                        <span class="image-label">Before</span>
                    </div>
                    <div class="image-container">
                        <img src="images/tafter.png" alt="After">
                        <span class="image-label">After</span>
                    </div>
                </div>
                <h3>Toyota Hilux Revo 2021 To Rocco GR Sport Conversion 2023</h3>
            </div>
            
            <div class="project-card">
                <div class="before-after">
                    <div class="image-container">
                        <img src="images/2b.png" alt="After">
                        <span class="image-label">Before</span>
                    </div>
                    <div class="image-container">
                        <img src="images/2a.png" alt="Before">
                        <span class="image-label">After</span>
                    </div>
                </div>
                <h3>Toyota Fortuner Upgrade With TRD Body Kit 2016 To 2021-2022</h3>
            </div>

            <div class="project-card">
                <div class="before-after">
                    <div class="image-container">
                        <img src="images/btoyota.png" alt="Before">
                        <span class="image-label">Before</span>
                    </div>
                    <div class="image-container">
                        <img src="images/tafter.png" alt="After">
                        <span class="image-label">After</span>
                    </div>
                </div>
                <h3>Toyota Hilux Revo 2021 To Rocco GR Sport Conversion 2023</h3>
            </div>

           
        </div>

        <div class="pagination">
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot active"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
    </div>
</section>


<section class="categories">
    <h2 class="categories-title">Categories</h2>
    <div class="categories-container">
        <div class="category-card">
            <img src="images/0000188_tyres-rims_450.jpeg" alt="Tyres & Rims" class="category-image">
            <p class="category-text">Tyres & Rims</p>
        </div>
        <div class="category-card">
            <img src="images/0000189_accessories_450.jpeg" alt="Accessories" class="category-image">
            <p class="category-text">Accessories</p>
        </div>
        <div class="category-card">
            <img src="images/0000190_oil-lubricants_450.jpeg" alt="Oil & Lubricants" class="category-image">
            <p class="category-text">Oil & Lubricants</p>
        </div>
        <div class="category-card">
            <img src="images/0000191_infotainment-systems_450.jpeg" alt="Infotainment Systems" class="category-image">
            <p class="category-text">Infotainment Systems</p>
        </div>
        <div class="category-card">
            <img src="images/0000154_brakes_450.png" alt="Brakes" class="category-image">
            <p class="category-text">Brakes</p>
        </div>
        <div class="category-card">
            <img src="images/0000177_electrical-parts_450.png" alt="Electrical Parts" class="category-image">
            <p class="category-text">Electrical Parts</p>
        </div>
        <div class="category-card">
            <img src="images/0000148_engine-parts_450.png" alt="Engine & Parts" class="category-image">
            <p class="category-text">Engine & Parts</p>
        </div>
        <div class="category-card">
            <img src="images/0000182_exterior_450.png" alt="Exterior" class="category-image">
            <p class="category-text">Exterior</p>
        </div>
        <div class="category-card">
            <img src="images/0000183_interior_450.png" alt="Interior" class="category-image">
            <p class="category-text">Interior</p>
        </div>
        <div class="category-card">
            <img src="images/0000146_lights_450.png" alt="Lights" class="category-image">
            <p class="category-text">Lights</p>
        </div>
        <div class="category-card">
            <img src="images/0000147_suspension_450.png" alt="Suspension" class="category-image">
            <p class="category-text">Suspension</p>
        </div>
        <div class="category-card">
            <img src="images/0000179_transmission-drivetrain_450.png" alt="Transmission & Drivetrain" class="category-image">
            <p class="category-text">Transmission & Drivetrain</p>
        </div>
    </div>
</section>

<!-- Add this after the projects section -->
<section class="features">
    <div class="container">
        <div class="features-grid">
            <div class="feature-card">
                <img src="images/placeholder.svg?height=50&width=50" alt="Money Back Guarantee" class="feature-icon">
                <h3>Money Back Guarantee</h3>
                <p>We deliver what we show</p>
                <ul class="feature-list">
                    <li>Big range of genuine products</li>
                    <li>Deliver items at doorstep</li>
                </ul>
            </div>

            <div class="feature-card">
                <img src="images/placeholder.svg?height=50&width=50" alt="Easy Shopping" class="feature-icon">
                <h3>Easy Online Shopping</h3>
                <p>Single click to buy products</p>
                <ul class="feature-list">
                    <li>Quick Delivery service</li>
                    <li>Online Customer Support</li>
                </ul>
            </div>

            <div class="feature-card">
                <img src="images/placeholder.svg?height=50&width=50" alt="Secure Payments" class="feature-icon">
                <h3>Secure Payments</h3>
                <p>Cash on delivery</p>
                <ul class="feature-list">
                    <li>Pay cash at your doorstep</li>
                    <li>Confirmation email & call</li>
                </ul>
            </div>
        </div>
    </div>
</section>



<footer class="footer">
    <div class="container footer-grid">
        <div class="footer-about">
            <img src="images/logo.png" alt="AutoStore.pk" width="120" height="100" class="">
            <p>Friends used auto parts – No.1 online Autostore for Car care and Car Accessories in Pakistan.</p>
            <div class="social-links">
                <a href="#" class="social-link">Facebook</a>
                <a href="#" class="social-link">Instagram</a>
                <a href="#" class="social-link">YouTube</a>
            </div>
        </div>

        <div class="footer-links">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="#">Blog</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Terms of Service</a></li>
                <li><a href="#">Privacy Policy</a></li>
            </ul>
        </div>

        <div class="footer-contact">
            <h4>Get in Touch</h4>
            <p>Call or WhatsApp</p>
            <p class="contact-phone">0302 2111 406</p>
            <p>Email Us</p>
            <p class="contact-email">info@aaa.pk</p>
        </div>

        <div class="footer-newsletter">
            <h4>Stay Updated</h4>
            <p>Get exciting discounts on your email address</p>
            <form class="newsletter-form">
                <input type="email" placeholder="Your email address" class="newsletter-input">
                <button type="submit" class="subscribe-button">Subscribe</button>
            </form>
        </div>
    </div>
</footer>
</body>
</html>