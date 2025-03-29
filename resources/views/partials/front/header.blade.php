
<div class="top-bar">
        <div class="top-bar-links">
            <!-- <a href="/blog">Blog</a> -->
            <a href="{{ route('about.us') }}">About Us</a>
            {{-- <a href="/contact">Contact Us</a> --}}
            <!-- <a href="/account">My Account</a> -->
        </div>
    </div>

    <div class="header-wrapper">
        <header class="header">
            <div class="header-content">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="AutoStore.pk" width="120" height="100">
                </a>
                    
                <div class="search-container">
                    <form action="{{ route('product.search') }}" method="GET" class="search-form">
                    <input type="text" name="query" placeholder="Search for products..." class="search-input">
                    </form>
                </div>
                <div class="contact-info">
                    <div class="contact-label">Call or WhatsApp</div>
                    <div class="phone-number">+92 306 7980000</div>
                </div>
            </div>
        </header>
    </div>

    <nav class="nav">
    <div class="nav-container">
        <!-- Home Link -->
        <a href="{{ route('home') }}" class="nav-link active">Home</a>

        <!-- Display the first 5 categories -->
        @foreach ($categories->take(5) as $category)
            <a href="{{ route('categories.show', $category->slug) }}" class="nav-link">
                {{ $category->name }}
            </a>
        @endforeach

        <!-- Dropdown for the remaining categories -->
        @if ($categories->count() > 5)
            <div class="dropdown">
                <button class="nav-link dropdown-toggle">Others</button>
                <div class="dropdown-content">
                    @foreach ($categories->slice(5) as $category)
                        <a href="{{ route('categories.show', $category->slug) }}" class="nav-link">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</nav>