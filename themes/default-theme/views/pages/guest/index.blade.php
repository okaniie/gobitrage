<x-template.guest>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="container position-relative">
            <div class="working-since">WORKING SINCE 2020</div>
            <div class="row align-items-center min-vh-50">
                <div class="col-lg-6 slide-in-left">
                    <h1 class="display-4 fw-bold mb-3 text-white">Welcome to Gobitrage</h1>
                    <p class="lead mb-4 text-white-75">Your trusted partner in cryptocurrency investment. Start your journey with as little as $20 and earn up to 50% weekly returns.</p>
                    <div class="d-flex gap-3 mb-4">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Get Started</a>
                        <a href="{{ url('/investment-plans') }}" class="btn btn-outline-light btn-lg">View Plans</a>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="text-center">
                            <div class="h3 text-white mb-0">50%</div>
                            <div class="text-white-75">Weekly Returns</div>
                        </div>
                        <div class="text-center">
                            <div class="h3 text-white mb-0">24/7</div>
                            <div class="text-white-75">Support</div>
                        </div>
                        <div class="text-center">
                            <div class="h3 text-white mb-0">$20</div>
                            <div class="text-white-75">Min Deposit</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 slide-in-right">
                    <div class="floating-elements">
                        <div class="float-element bitcoin">
                            <img src="/assets/images/bitcoin.svg" alt="Bitcoin" class="float-icon">
                        </div>
                        <div class="float-element ethereum">
                            <img src="/assets/images/ethereum.svg" alt="Ethereum" class="float-icon">
                        </div>
                        <div class="float-element chart">
                            <img src="/assets/images/chart.svg" alt="Chart" class="float-icon">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .hero-section {
                position: relative;
                overflow: hidden;
                background: url('/assets/images/hero-meeting.jpg') no-repeat center center;
                background-size: cover;
                min-height: 50vh;
                display: flex;
                align-items: center;
            }
            .hero-overlay {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(135deg, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.6) 100%);
                z-index: 1;
            }
            .hero-section .container {
                z-index: 2;
            }
            .min-vh-50 {
                min-height: 50vh;
            }
            .text-white-75 {
                color: rgba(255, 255, 255, 0.75);
            }
            .floating-elements {
                position: relative;
                height: 100%;
                min-height: 200px;
            }
            .float-element {
                position: absolute;
                animation: float 6s ease-in-out infinite;
                z-index: 3;
            }
            .float-element.bitcoin {
                top: 10%;
                right: 10%;
                animation-delay: 0s;
            }
            .float-element.ethereum {
                top: 40%;
                right: 5%;
                animation-delay: 2s;
            }
            .float-element.chart {
                bottom: 20%;
                right: 15%;
                animation-delay: 4s;
            }
            .float-icon {
                width: 60px;
                height: 60px;
                filter: drop-shadow(0 0 10px rgba(0, 255, 136, 0.3));
            }
            @keyframes float {
                0% {
                    transform: translateY(0px);
                }
                50% {
                    transform: translateY(-20px);
                }
                100% {
                    transform: translateY(0px);
                }
            }
            @media (max-width: 991.98px) {
                .hero-section {
                    text-align: center;
                    min-height: 40vh;
                }
                .min-vh-50 {
                    min-height: 40vh;
                }
                .d-flex {
                    justify-content: center;
                }
                .floating-elements {
                    min-height: 150px;
                    margin-top: 2rem;
                }
                .float-icon {
                    width: 50px;
                    height: 50px;
                }
            }
            @media (max-width: 768px) {
                .hero-section {
                    min-height: 35vh;
                }
                .min-vh-50 {
                    min-height: 35vh;
                }
                .display-4 {
                    font-size: 2rem;
                }
                .lead {
                    font-size: 0.9rem;
                }
                .btn-lg {
                    padding: 0.5rem 1rem;
                    font-size: 0.9rem;
                }
                .h3 {
                    font-size: 1.5rem;
                }
                .text-white-75 {
                    font-size: 0.8rem;
                }
            }
            .working-since {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(5px);
                padding: 6px 16px;
                border-radius: 50px;
                color: white;
                display: inline-block;
                margin-bottom: 1.5rem;
                font-weight: 500;
                letter-spacing: 1px;
                border: 1px solid rgba(255, 255, 255, 0.2);
                font-size: 0.9rem;
            }
        </style>
    </section>

    <!-- CTA Section -->
    <section class="py-4 bg-primary text-white">
        <div class="container text-center">
            <h2 class="mb-3 fade-in">Ready to Start Your Investment Journey?</h2>
            <p class="lead mb-3 fade-in" style="animation-delay: 0.2s;">Join thousands of successful investors who trust Gobitrage with their investments.</p>
            <a href="{{ route('register') }}" class="btn btn-light btn-lg fade-in" style="animation-delay: 0.4s;">Create Account Now</a>
        </div>
    </section>

    <!-- Cryptocurrencies Section -->
    <section class="py-5 crypto-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">WE WORK WITH E-CURRENCIES</h2>
                <p class="text-muted">Fast and secure transactions</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-3 col-6 mb-4">
                    <div class="crypto-card">
                        <img src="/assets/images/btc.svg" alt="Bitcoin" class="crypto-icon">
                        <h4>Bitcoin</h4>
                        @auth
                            <a href="{{ route('user.deposits') }}" class="crypto-btn">Deposit Now</a>
                        @else
                            <a href="{{ route('register') }}" class="crypto-btn">Deposit Now</a>
                        @endauth
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="crypto-card">
                        <img src="/assets/images/usdt.svg" alt="USDT" class="crypto-icon">
                        <h4>USDT</h4>
                        @auth
                            <a href="{{ route('user.deposits') }}" class="crypto-btn">Deposit Now</a>
                        @else
                            <a href="{{ route('register') }}" class="crypto-btn">Deposit Now</a>
                        @endauth
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="crypto-card">
                        <img src="/assets/images/tron.svg" alt="TRON" class="crypto-icon">
                        <h4>TRON</h4>
                        @auth
                            <a href="{{ route('user.deposits') }}" class="crypto-btn">Deposit Now</a>
                        @else
                            <a href="{{ route('register') }}" class="crypto-btn">Deposit Now</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        <style>
            .crypto-section {
                background: linear-gradient(135deg, rgba(0, 0, 0, 0.02) 0%, rgba(0, 0, 0, 0.05) 100%);
            }
            .crypto-card {
                background: white;
                border-radius: 15px;
                padding: 2rem;
                text-align: center;
                transition: all 0.3s ease;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
                height: 100%;
            }
            .crypto-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            }
            .crypto-icon {
                width: 80px;
                height: 80px;
                margin-bottom: 1.5rem;
            }
            .crypto-card h4 {
                font-size: 1.2rem;
                margin-bottom: 1rem;
                color: #333;
            }
            .crypto-btn {
                display: inline-block;
                padding: 8px 20px;
                background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
                color: white;
                text-decoration: none;
                border-radius: 25px;
                font-size: 0.9rem;
                transition: all 0.3s ease;
            }
            .crypto-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                color: white;
            }
            @media (max-width: 768px) {
                .crypto-card {
                    padding: 1.5rem;
                }
                .crypto-icon {
                    width: 60px;
                    height: 60px;
                    margin-bottom: 1rem;
                }
                .crypto-card h4 {
                    font-size: 1rem;
                    margin-bottom: 0.8rem;
                }
                .crypto-btn {
                    padding: 6px 16px;
                    font-size: 0.8rem;
                }
            }
        </style>
    </section>

    <!-- ACRA Certificate Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center display-5 fw-bold mb-4">Licensed & Regulated</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <img src="/assets/images/acra-certificate.jpg" alt="ACRA Certificate" class="img-fluid rounded-3 shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 features-section">
        <div class="features-overlay"></div>
        <div class="container position-relative">
            <h2 class="text-center mb-5 fade-in text-white">Why Choose Gobitrage?</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-box fade-in">
                        <i class="bi bi-shield-check"></i>
                        <h3>Secure Investment</h3>
                        <p>Your funds are protected with state-of-the-art security measures and transparent operations.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box fade-in" style="animation-delay: 0.2s;">
                        <i class="bi bi-graph-up"></i>
                        <h3>High Returns</h3>
                        <p>Earn up to 50% weekly returns on your investments through our proven trading strategies.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box fade-in" style="animation-delay: 0.4s;">
                        <i class="bi bi-clock"></i>
                        <h3>24/7 Support</h3>
                        <p>Our dedicated support team is always available to assist you with any queries.</p>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .features-section {
                position: relative;
                background: url('assets/images/business-professional.jpg') no-repeat center center;
                background-size: cover;
                background-attachment: fixed;
                padding: 6rem 0;
                overflow: hidden;
            }
            .features-overlay {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(135deg, rgba(0, 0, 0, 0.85) 0%, rgba(0, 0, 0, 0.75) 100%);
                z-index: 1;
            }
            .features-section .container {
                position: relative;
                z-index: 2;
            }
            .feature-box {
                background: rgba(255, 255, 255, 0.95);
                padding: 2rem;
                border-radius: 15px;
                margin-bottom: 2rem;
                transition: all 0.3s ease;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            }
            .feature-box:hover {
                transform: translateY(-10px);
                box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            }
            .feature-box i {
                font-size: 2.5rem;
                color: var(--secondary-color);
                margin-bottom: 1.5rem;
            }
            .feature-box h3 {
                font-size: 1.5rem;
                margin-bottom: 1rem;
                color: var(--dark-bg);
            }
            .feature-box p {
                color: #666;
                margin-bottom: 0;
                line-height: 1.6;
            }
            @media (max-width: 768px) {
                .features-section {
                    padding: 4rem 0;
                    background-attachment: scroll;
                }
                .feature-box {
                    padding: 1.5rem;
                    margin-bottom: 1rem;
                }
                .feature-box i {
                    font-size: 2rem;
                    margin-bottom: 1rem;
                }
                .feature-box h3 {
                    font-size: 1.3rem;
                }
                .feature-box p {
                    font-size: 0.9rem;
                }
            }
        </style>
    </section>

    <!-- How to Join Section -->
    <section class="py-5 bg-gradient">
        <div class="container">
            <h2 class="text-center mb-5 fade-in">How to Join Gobitrage</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card h-100 border-0 shadow-sm hover-lift">
                        <div class="card-body text-center p-4">
                            <div class="icon-box mb-4">
                                <i class="bi bi-person-plus-fill display-4 text-primary"></i>
                            </div>
                            <h4 class="h5 mb-3">Create Account</h4>
                            <p class="text-muted mb-0">Sign up for a free account in just a few minutes. No verification required to get started.</p>
                            <div class="step-number">1</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 border-0 shadow-sm hover-lift">
                        <div class="card-body text-center p-4">
                            <div class="icon-box mb-4">
                                <i class="bi bi-wallet2 display-4 text-primary"></i>
                            </div>
                            <h4 class="h5 mb-3">Choose Plan</h4>
                            <p class="text-muted mb-0">Select your preferred investment plan and deposit funds using our secure payment methods.</p>
                            <div class="step-number">2</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 border-0 shadow-sm hover-lift">
                        <div class="card-body text-center p-4">
                            <div class="icon-box mb-4">
                                <i class="bi bi-graph-up-arrow display-4 text-primary"></i>
                            </div>
                            <h4 class="h5 mb-3">Start Earning</h4>
                            <p class="text-muted mb-0">Watch your investment grow with our proven trading strategies and expert management.</p>
                            <div class="step-number">3</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 border-0 shadow-sm hover-lift">
                        <div class="card-body text-center p-4">
                            <div class="icon-box mb-4">
                                <i class="bi bi-cash-stack display-4 text-primary"></i>
                            </div>
                            <h4 class="h5 mb-3">Withdraw Profits</h4>
                            <p class="text-muted mb-0">Withdraw your earnings anytime using our fast and secure withdrawal system.</p>
                            <div class="step-number">4</div>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                .bg-gradient {
                    background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-bg) 100%);
                    color: var(--text-color);
                }
                .icon-box {
                    width: 80px;
                    height: 80px;
                    margin: 0 auto;
                    background: rgba(255, 255, 255, 0.1);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    transition: all 0.3s ease;
                }
                .card:hover .icon-box {
                    transform: scale(1.1);
                    background: rgba(255, 255, 255, 0.2);
                }
                .hover-lift {
                    transition: all 0.3s ease;
                    background: rgba(255, 255, 255, 0.05);
                }
                .hover-lift:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
                }
                .step-number {
                    position: absolute;
                    top: 1rem;
                    right: 1rem;
                    width: 30px;
                    height: 30px;
                    background: rgba(255, 255, 255, 0.1);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-weight: bold;
                    color: var(--text-color);
                    border: 2px solid var(--text-color);
                }
                .card {
                    position: relative;
                    overflow: hidden;
                }
                .card::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: linear-gradient(45deg, rgba(0, 255, 136, 0.1), rgba(255, 51, 102, 0.1));
                    opacity: 0;
                    transition: all 0.3s ease;
                }
                .card:hover::before {
                    opacity: 1;
                }
            </style>
        </div>
    </section>

    <!-- Investment Plans Section -->
    <section class="py-5 investment-plans">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-4 fw-bold mb-3 fade-in">Investment Plans</h2>
                <p class="lead fade-in" style="animation-delay: 0.2s;">Choose the perfect investment plan that suits your goals</p>
            </div>
            <div class="row g-4">
                <div class="col-md-3 col-sm-6">
                    @auth
                        <a href="{{ route('user.deposits') }}?plan=basic" class="text-decoration-none">
                    @else
                        <a href="{{ route('register') }}" class="text-decoration-none">
                    @endauth
                        <div class="card hover-lift fade-in h-100">
                            <div class="card-body text-center p-3">
                                <div class="icon-box mb-3">
                                    <i class="bi bi-piggy-bank text-primary"></i>
                                </div>
                                <h3 class="card-title">Basic Plan</h3>
                                <div class="price-tag mb-3">
                                    <h4 class="mb-0">$20 - $399</h4>
                                    <p class="text-muted mb-0">Profit: 8%</p>
                                </div>
                                <ul class="list-unstyled mb-3">
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Min: $20</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Max: $399</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Profit: 8%</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>24 hours</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>5% Referral</li>
                                </ul>
                                <div class="btn btn-primary">Invest Now</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    @auth
                        <a href="{{ route('user.deposits') }}?plan=standard" class="text-decoration-none">
                    @else
                        <a href="{{ route('register') }}" class="text-decoration-none">
                    @endauth
                        <div class="card hover-lift fade-in h-100" style="animation-delay: 0.2s;">
                            <div class="card-body text-center p-3">
                                <div class="icon-box mb-3">
                                    <i class="bi bi-gem text-primary"></i>
                                </div>
                                <h3 class="card-title">Standard Plan</h3>
                                <div class="price-tag mb-3">
                                    <h4 class="mb-0">$400 - $3,999</h4>
                                    <p class="text-muted mb-0">Profit: 15%</p>
                                </div>
                                <ul class="list-unstyled mb-3">
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Min: $400</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Max: $3,999</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Profit: 15%</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>48 hours</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>7% Referral</li>
                                </ul>
                                <div class="btn btn-primary">Invest Now</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    @auth
                        <a href="{{ route('user.deposits') }}?plan=premium" class="text-decoration-none">
                    @else
                        <a href="{{ route('register') }}" class="text-decoration-none">
                    @endauth
                        <div class="card hover-lift fade-in h-100" style="animation-delay: 0.4s;">
                            <div class="card-body text-center p-3">
                                <div class="icon-box mb-3">
                                    <i class="bi bi-diamond-fill text-primary"></i>
                                </div>
                                <h3 class="card-title">Premium Plan</h3>
                                <div class="price-tag mb-3">
                                    <h4 class="mb-0">$4,000 - $7,999</h4>
                                    <p class="text-muted mb-0">Profit: 20%</p>
                                </div>
                                <ul class="list-unstyled mb-3">
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Min: $4,000</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Max: $7,999</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Profit: 20%</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>72 hours</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>10% Referral</li>
                                </ul>
                                <div class="btn btn-primary">Invest Now</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    @auth
                        <a href="{{ route('user.deposits') }}?plan=vip" class="text-decoration-none">
                    @else
                        <a href="{{ route('register') }}" class="text-decoration-none">
                    @endauth
                        <div class="card hover-lift fade-in h-100" style="animation-delay: 0.6s;">
                            <div class="card-body text-center p-3">
                                <div class="icon-box mb-3">
                                    <i class="bi bi-trophy text-primary"></i>
                                </div>
                                <h3 class="card-title">VIP Plan</h3>
                                <div class="price-tag mb-3">
                                    <h4 class="mb-0">$8,000+</h4>
                                    <p class="text-muted mb-0">Profit: 25%</p>
                                </div>
                                <ul class="list-unstyled mb-3">
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Min: $8,000</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Max: No limit</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Profit: 25%</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>76 hours</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>12% Referral</li>
                                </ul>
                                <div class="btn btn-primary">Invest Now</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-5 testimonials-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-4 fw-bold mb-3 fade-in">What Our Investors Say</h2>
                <p class="lead fade-in" style="animation-delay: 0.2s;">Join thousands of satisfied investors who trust Gobitrage</p>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card slide-in-left">
                        <div class="testimonial-content">
                            <div class="testimonial-icon">
                                <i class="bi bi-quote"></i>
                            </div>
                            <p class="testimonial-text">"I've been investing with Gobitrage for over a year now, and the returns have been consistently excellent. The support team is always helpful and responsive."</p>
                            <div class="testimonial-author">
                                <div class="author-avatar">JD</div>
                                <div class="author-info">
                                    <h5>John Doe</h5>
                                    <span>Professional Investor</span>
                                </div>
                            </div>
                            <div class="testimonial-rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card slide-in-left" style="animation-delay: 0.2s;">
                        <div class="testimonial-content">
                            <div class="testimonial-icon">
                                <i class="bi bi-quote"></i>
                            </div>
                            <p class="testimonial-text">"The platform is user-friendly and secure. I started with a small investment and gradually increased it as I saw the consistent returns."</p>
                            <div class="testimonial-author">
                                <div class="author-avatar">JS</div>
                                <div class="author-info">
                                    <h5>Jane Smith</h5>
                                    <span>Business Owner</span>
                                </div>
                            </div>
                            <div class="testimonial-rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card slide-in-left" style="animation-delay: 0.4s;">
                        <div class="testimonial-content">
                            <div class="testimonial-icon">
                                <i class="bi bi-quote"></i>
                            </div>
                            <p class="testimonial-text">"Gobitrage has transformed my investment portfolio. The weekly returns are impressive, and the withdrawal process is smooth."</p>
                            <div class="testimonial-author">
                                <div class="author-avatar">MJ</div>
                                <div class="author-info">
                                    <h5>Mike Johnson</h5>
                                    <span>Entrepreneur</span>
                                </div>
                            </div>
                            <div class="testimonial-rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .testimonials-section {
                background: linear-gradient(135deg, rgba(0, 255, 136, 0.05) 0%, rgba(255, 51, 102, 0.05) 100%);
                padding: 5rem 0;
            }
            .testimonial-card {
                background: #ffffff;
                border-radius: 20px;
                padding: 2rem;
                height: 100%;
                transition: all 0.4s ease;
                position: relative;
                overflow: hidden;
                box-shadow: 0 10px 30px rgba(0, 255, 136, 0.1);
            }
            .testimonial-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 5px;
                background: linear-gradient(90deg, var(--secondary-color), var(--accent-color));
            }
            .testimonial-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 20px 40px rgba(0, 255, 136, 0.2);
            }
            .testimonial-icon {
                font-size: 3rem;
                color: var(--secondary-color);
                opacity: 0.2;
                margin-bottom: 1.5rem;
            }
            .testimonial-text {
                font-size: 1.1rem;
                line-height: 1.8;
                color: #666;
                margin-bottom: 2rem;
                font-style: italic;
            }
            .testimonial-author {
                display: flex;
                align-items: center;
                margin-bottom: 1rem;
            }
            .author-avatar {
                width: 50px;
                height: 50px;
                background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-weight: bold;
                font-size: 1.2rem;
                margin-right: 1rem;
            }
            .author-info h5 {
                margin: 0;
                font-size: 1.1rem;
                color: var(--dark-bg);
            }
            .author-info span {
                font-size: 0.9rem;
                color: #666;
            }
            .testimonial-rating {
                color: #ffc107;
                font-size: 1.2rem;
            }
            @media (max-width: 768px) {
                .testimonials-section {
                    padding: 3rem 0;
                }
                .testimonial-card {
                    padding: 1.5rem;
                }
                .testimonial-text {
                    font-size: 1rem;
                }
                .author-avatar {
                    width: 40px;
                    height: 40px;
                    font-size: 1rem;
                }
                .author-info h5 {
                    font-size: 1rem;
                }
                .author-info span {
                    font-size: 0.8rem;
                }
            }
        </style>
    </section>
</x-template.guest>

<style>
    .container {
        max-width: 1280px !important;
        width: 100% !important;
        margin-right: auto;
        margin-left: auto;
        padding-right: 15px;
        padding-left: 15px;
    }

    @media (max-width: 1280px) {
        .container {
            width: 100% !important;
            padding-right: 20px;
            padding-left: 20px;
        }
    }

    @media (max-width: 768px) {
        .container {
            width: 100% !important;
            padding-right: 15px;
            padding-left: 15px;
        }

        .row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 0;
            width: 100%;
        }

        .col-md-3, .col-md-4 {
            width: 100%;
            flex: 0 0 100%;
            max-width: 100%;
            padding: 0;
        }

        .card {
            margin-bottom: 15px;
            padding: 15px;
            height: 100%;
            transform: scale(0.9);
            transform-origin: center center;
        }

        .hero-section {
            padding: 30px 0;
        }

        .display-4 {
            font-size: 1.8rem;
        }

        .lead {
            font-size: 1rem;
        }

        .btn-lg {
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
        }

        .icon-box {
            width: 60px;
            height: 60px;
        }

        .bi {
            font-size: 1.5rem;
        }

        .card-body {
            padding: 1rem;
        }

        .card-title {
            font-size: 1.2rem;
            margin-bottom: 0.8rem;
        }

        .price-tag {
            padding: 1rem;
            margin: 0.8rem 0;
        }

        .price-tag h4 {
            font-size: 1.1rem;
        }

        .list-unstyled li {
            font-size: 0.9rem;
            margin-bottom: 0.6rem;
        }

        .step-number {
            width: 30px;
            height: 30px;
            font-size: 1rem;
        }

        .feature-box {
            padding: 1.2rem;
            margin-bottom: 1.2rem;
        }

        .feature-box h3 {
            font-size: 1.1rem;
            margin: 0.8rem 0;
        }

        .feature-box p {
            font-size: 0.9rem;
        }

        .section-title {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
        }

        .bg-gradient {
            padding: 2rem 0;
        }

        /* Investment Plans Mobile Specific */
        .investment-plans .card {
            transform: none;
            margin-bottom: 1rem;
            height: auto;
        }

        .investment-plans .card-body {
            padding: 1rem;
        }

        .investment-plans .icon-box {
            width: 50px;
            height: 50px;
            margin-bottom: 0.8rem;
        }

        .investment-plans .bi {
            font-size: 1.2rem;
        }

        .investment-plans .card-title {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }

        .investment-plans .price-tag {
            padding: 0.5rem;
            margin: 0.5rem 0;
        }

        .investment-plans .price-tag h4 {
            font-size: 1rem;
        }

        .investment-plans .list-unstyled li {
            font-size: 0.8rem;
            margin-bottom: 0.3rem;
        }

        .investment-plans .btn-primary {
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
        }

        .investment-plans .row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.5rem;
        }

        .investment-plans .col-sm-6 {
            padding: 0.25rem;
        }

        /* Testimonials Mobile Specific */
        .testimonial-card {
            transform: scale(0.9);
            transform-origin: center center;
        }

        .testimonial-text {
            font-size: 0.9rem;
        }

        .author-avatar {
            width: 40px;
            height: 40px;
            font-size: 0.9rem;
        }

        .author-info h5 {
            font-size: 0.9rem;
        }

        .author-info span {
            font-size: 0.8rem;
        }
    }

    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
    .scale-in {
        animation: scaleIn 0.5s ease forwards;
        opacity: 0;
    }
    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    .fade-in {
        animation: fadeIn 0.5s ease forwards;
        opacity: 0;
    }
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .price-tag {
        background: linear-gradient(45deg, rgba(0, 255, 136, 0.1), rgba(255, 51, 102, 0.1));
        padding: 1rem;
        border-radius: 10px;
        border: 1px solid rgba(0, 255, 136, 0.1);
    }
    .card {
        border: 1px solid rgba(0,0,0,0.05);
    }
    .text-dark {
        color: #212529 !important;
    }
    .icon-box {
        width: 80px;
        height: 80px;
        margin: 0 auto;
        background: rgba(0, 255, 136, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    .card:hover .icon-box {
        transform: scale(1.1);
        background: rgba(0, 255, 136, 0.2);
    }
    .hover-lift {
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(0, 255, 136, 0.1);
    }
    .hover-lift:hover {
        transform: translateY(-10px);
        box-shadow: 0 1rem 3rem rgba(0, 255, 136, 0.2) !important;
    }
    .bi {
        font-size: 2rem;
        color: var(--secondary-color);
    }
    .text-primary {
        color: #ffffff !important;
    }
    .btn-primary {
        background-color: var(--secondary-color);
        border-color: var(--secondary-color);
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background-color: var(--accent-color);
        border-color: var(--accent-color);
        transform: translateY(-2px);
    }
    .investment-plans {
        background: linear-gradient(135deg, rgba(0, 255, 136, 0.05) 0%, rgba(255, 51, 102, 0.05) 100%);
        padding: 4rem 0;
    }
    .investment-plans .card {
        background: rgba(255, 255, 255, 0.95);
        border: none;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s ease;
        position: relative;
    }
    .investment-plans .card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, var(--secondary-color), var(--accent-color));
    }
    .investment-plans .card:hover {
        transform: translateY(-15px);
        box-shadow: 0 20px 40px rgba(0, 255, 136, 0.2);
    }
    .investment-plans .icon-box {
        width: 90px;
        height: 90px;
        background: linear-gradient(135deg, rgba(0, 255, 136, 0.2), rgba(255, 51, 102, 0.2));
        border-radius: 50%;
        margin-bottom: 1.5rem;
        transition: all 0.4s ease;
    }
    .investment-plans .card:hover .icon-box {
        transform: scale(1.1) rotate(5deg);
    }
    .investment-plans .card-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--dark-bg);
        margin-bottom: 1.5rem;
        position: relative;
        display: inline-block;
    }
    .investment-plans .card-title::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, var(--secondary-color), var(--accent-color));
        border-radius: 3px;
    }
    .investment-plans .price-tag {
        background: linear-gradient(135deg, rgba(0, 255, 136, 0.15), rgba(255, 51, 102, 0.15));
        padding: 1.5rem;
        border-radius: 15px;
        margin: 1.5rem 0;
        border: 2px solid rgba(0, 255, 136, 0.2);
    }
    .investment-plans .price-tag h4 {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--dark-bg);
        margin-bottom: 0.5rem;
    }
    .investment-plans .price-tag p {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--secondary-color);
        margin: 0;
    }
    .investment-plans .list-unstyled li {
        font-size: 1.1rem;
        margin-bottom: 1rem;
        padding-left: 1.5rem;
        position: relative;
    }
    .investment-plans .list-unstyled li i {
        position: absolute;
        left: 0;
        color: var(--secondary-color);
        font-size: 1.2rem;
    }
    .investment-plans .btn-primary {
        padding: 1rem 2rem;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 50px;
        background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
        border: none;
        box-shadow: 0 5px 15px rgba(0, 255, 136, 0.3);
        transition: all 0.4s ease;
    }
    .investment-plans .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 255, 136, 0.4);
    }
    @media (max-width: 768px) {
        .investment-plans .card {
            margin-bottom: 2rem;
        }
        .investment-plans .card-title {
            font-size: 1.6rem;
        }
        .investment-plans .price-tag h4 {
            font-size: 1.5rem;
        }
        .investment-plans .list-unstyled li {
            font-size: 1rem;
        }
    }
</style>
