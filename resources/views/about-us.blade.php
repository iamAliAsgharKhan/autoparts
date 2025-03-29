@extends('layouts.main') {{-- Use your main front-end layout --}}

@section('title', 'About Us') {{-- Sets the page title --}}

@section('additional-styles') {{-- Page-specific styles --}}
<style>
    .about-hero {
        background-color: #2B2D42; /* Match header color */
        color: #fff;
        padding: 60px 20px;
        text-align: center;
        margin-bottom: 40px;
    }
    .about-hero h1 {
        font-size: 2.8rem;
        font-weight: bold;
        margin-bottom: 15px;
    }
    .about-hero p {
        font-size: 1.2rem;
        max-width: 800px;
        margin: 0 auto;
        color: #eee;
    }

    .about-section {
        padding: 40px 0;
        border-bottom: 1px solid #eee; /* Separator */
    }
    .about-section:last-child {
        border-bottom: none;
    }

    .about-section h2 {
        text-align: center;
        font-size: 2.2rem;
        color: #333;
        margin-bottom: 40px;
        position: relative;
    }
    /* Underline effect for section titles */
    .about-section h2::after {
        content: '';
        display: block;
        width: 60px;
        height: 4px;
        background-color: #ff0000; /* Accent color */
        margin: 10px auto 0;
    }

    .about-content {
        line-height: 1.8;
        color: #555;
        font-size: 1.05rem;
    }
    .about-content p {
        margin-bottom: 1.5em;
    }

    /* Specific sections styling */
    .mission-vision {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        align-items: start; /* Align items to the top */
    }
    .mission-vision div {
        background-color: #f8f9fa;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .mission-vision h3 {
        font-size: 1.5rem;
        color: #2B2D42;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    }
     .mission-vision h3 i { /* Style icons */
        margin-right: 10px;
        color: #ff0000;
     }

    .values-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        text-align: center;
    }
    .value-card {
        padding: 25px;
    }
    .value-card i { /* Value icons */
        font-size: 2.5rem;
        color: #ff0000; /* Accent color */
        margin-bottom: 15px;
    }
    .value-card h4 {
        font-size: 1.3rem;
        color: #333;
        margin-bottom: 10px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .about-hero h1 { font-size: 2.2rem; }
        .about-hero p { font-size: 1rem; }
        .about-section h2 { font-size: 1.8rem; }
        .mission-vision { grid-template-columns: 1fr; }
        .values-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 992px) {
        .mission-vision { gap: 20px; }
        .mission-vision div { padding: 20px; }
    }

</style>
@endsection

@section('content')

    {{-- 1. Hero Section --}}
    <section class="about-hero">
        <div class="container">
            <h1>About Friends Used Auto Parts</h1>
            <p>Your trusted source for quality used auto parts and expert mechanical services in Pakistan. We're passionate about cars and dedicated to keeping yours running smoothly.</p>
        </div>
    </section>

    {{-- Main Content Area --}}
    <div class="container">

        {{-- 2. Our Story Section --}}
        <section class="about-section">
            <h2>Our Story</h2>
            <div class="about-content">
                <p>
                    Founded by a group of car enthusiasts and experienced mechanics, Friends Used Auto Parts started with a simple goal: to provide reliable, affordable auto parts and trustworthy repair services. We saw a need in the market for high-quality used parts that customers could depend on, combined with the expertise to ensure proper fitment and installation.
                </p>
                <p>
                    From our humble beginnings [mention something specific if possible, e.g., "in a small workshop in Lahore" or "serving local car owners"], we've grown thanks to our commitment to customer satisfaction and our deep knowledge of automobiles. We source parts carefully, inspect them rigorously, and offer them to you with confidence.
                </p>
                 {{-- Add more paragraphs as needed --}}
            </div>
        </section>

        {{-- 3. Mission & Vision Section --}}
        <section class="about-section">
            <h2>Mission & Vision</h2>
            <div class="mission-vision">
                <div>
                    <h3><i class="fas fa-bullseye"></i> Our Mission</h3>
                    <p>To be the leading provider of dependable used auto parts and exceptional mechanical services in Pakistan, ensuring customer safety and satisfaction through quality products, expert knowledge, and fair pricing.</p>
                </div>
                <div>
                    <h3><i class="fas fa-eye"></i> Our Vision</h3>
                    <p>To build a community of satisfied car owners who trust us implicitly for all their auto parts and service needs, fostering long-term relationships built on reliability and transparency.</p>
                </div>
            </div>
        </section>

        {{-- 4. Our Values Section --}}
        <section class="about-section">
            <h2>Our Core Values</h2>
            <div class="values-grid">
                <div class="value-card">
                    <i class="fas fa-shield-alt"></i>
                    <h4>Quality & Reliability</h4>
                    <p>We stand behind the parts we sell and the services we provide. Every part is inspected for quality assurance.</p>
                </div>
                <div class="value-card">
                    <i class="fas fa-handshake"></i>
                    <h4>Customer Focus</h4>
                    <p>Your needs come first. We strive to offer personalized service and find the right solutions for your vehicle.</p>
                </div>
                <div class="value-card">
                    <i class="fas fa-check-circle"></i>
                    <h4>Integrity & Honesty</h4>
                    <p>We believe in transparent pricing and honest communication. No hidden fees, no unnecessary upselling.</p>
                </div>
                <div class="value-card">
                    <i class="fas fa-wrench"></i>
                    <h4>Expertise</h4>
                    <p>Our team consists of knowledgeable mechanics and parts specialists passionate about automobiles.</p>
                </div>
            </div>
        </section>

        {{-- 5. Why Choose Us Section (Optional - can link back to features) --}}
        <section class="about-section">
            <h2>Why Choose Friends Used Auto Parts?</h2>
             <div class="about-content">
                <p>
                    Choosing where to buy parts or get your car serviced is important. At Friends Used Auto Parts, we offer several key advantages:
                </p>
                <ul>
                    <li><strong>Wide Selection:</strong> Access to a vast inventory of quality used parts for various makes and models.</li>
                    <li><strong>Expert Team:</strong> Experienced mechanics ready to assist with installation and repairs.</li>
                    <li><strong>Affordability:</strong> Save money without compromising on quality with our used parts.</li>
                    <li><strong>Convenience:</strong> Easy ordering process [mention WhatsApp if applicable] and helpful customer support.</li>
                    <li><strong>Trust:</strong> We build relationships based on honesty and reliable service.</li>
                </ul>
                <p class="text-center mt-4">
                   Ready to find the parts you need? <a href="{{ route('home') }}#search-parts" class="btn btn-primary">Search Parts Now</a> or <a href="#footer-contact" class="btn btn-outline-primary">Contact Us</a>!
                </p>
            </div>
        </section>

    </div> {{-- End .container --}}

@endsection