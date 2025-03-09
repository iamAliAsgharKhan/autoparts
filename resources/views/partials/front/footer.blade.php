

<section class="features">
    <div class="container">
        <div class="features-grid">
            <div class="feature-card">
                <img src="data:image/svg+xml,%3Csvg%20class='w-6%20h-6%20text-gray-800%20dark:text-white'%20aria-hidden='true'%20xmlns='http://www.w3.org/2000/svg'%20width='24'%20height='24'%20fill='currentColor'%20viewBox='0%200%2024%2024'%3E%3Cpath%20fill-rule='evenodd'%20d='M2%2012C2%206.477%206.477%202%2012%202s10%204.477%2010%2010-4.477%2010-10%2010S2%2017.523%202%2012Zm13.707-1.293a1%201%200%200%200-1.414-1.414L11%2012.586l-1.793-1.793a1%201%200%200%200-1.414%201.414l2.5%202.5a1%201%200%200%200%201.414%200l4-4Z'%20clip-rule='evenodd'/%3E%3C/svg%3E" 
                     alt="Check Icon" class="feature-icon">
                <h3>Money Back Guarantee</h3>
                <p>We deliver what we show</p>
                <ul class="feature-list">
                    <li>Big range of genuine products</li>
                    <li>Contact us via WhatsApp for personalized support</li>
                </ul>
            </div>
            <div class="feature-card">
                <img src="data:image/svg+xml;utf8,<svg width='50' height='50' viewBox='0 0 64 64' fill='none' xmlns='http://www.w3.org/2000/svg'><path d='M16 16h40l-6 24H22L16 16z' stroke='%23000' stroke-width='2' stroke-linejoin='round'/><circle cx='24' cy='52' r='3' fill='%23000'/><circle cx='48' cy='52' r='3' fill='%23000'/></svg>" 
                     alt="WhatsApp Icon" class="feature-icon">
                <h3>Direct WhatsApp Orders</h3>
                <p>Instant consultation and order placement via WhatsApp</p>
                <ul class="feature-list">
                    <li>Chat with our product experts</li>
                    <li>Personalized order assistance</li>
                </ul>
            </div>
            <div class="feature-card">
                <img src="data:image/svg+xml;utf8,<svg class=&quot;w-6 h-6 text-gray-800 dark:text-white&quot; aria-hidden=&quot;true&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot; width=&quot;24&quot; height=&quot;24&quot; fill=&quot;currentColor&quot; viewBox=&quot;0 0 24 24&quot;&gt;&lt;path fill-rule=&quot;evenodd&quot; d=&quot;M8 10V7a4 4 0 1 1 8 0v3h1a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h1Zm2-3a2 2 0 1 1 4 0v3h-4V7Zm2 6a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1Z&quot; clip-rule=&quot;evenodd&quot;/&gt;&lt;/svg&gt;" 
                     alt="Secure Offline Transactions Icon" class="feature-icon">
                <h3>Secure Transactions</h3>
                <p>Payment arranged directly after consultation</p>
                <ul class="feature-list">
                    <li>Personalized payment process via WhatsApp</li>
                    <li>Safe and verified transactions</li>
                </ul>
            </div>
        </div>
    </div>
</section>


<footer class="footer">
    <div class="container footer-grid">
        <div class="footer-about">
            <img src="{{ asset('images/logo.png') }}" alt="AutoStore.pk" width="120" height="100" class="">
            <p>Friends used auto parts – No.1 online Autostore for Car care and Car Accessories in Pakistan.</p>
            <div class="social-links">
            @foreach ($socialLinks as $link)
                <a href="{{ $link->url }}" target="_blank" class="social-link">
                    <i class="{{ $link->icon }}"></i> 
                </a>
            @endforeach
                
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
            <p class="contact-phone">+92 306 7980000</p>
            <p>Email Us</p>
            <p class="contact-email">
            mbasharat78@gmail.com</p>
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

