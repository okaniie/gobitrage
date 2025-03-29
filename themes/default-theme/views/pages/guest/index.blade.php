<x-template.guest>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 slide-in-left">
                    <h1 class="display-4 fw-bold mb-4">Welcome to Gobitrage</h1>
                    <p class="lead mb-4">Your trusted partner in cryptocurrency investment. Start your journey with as little as $100 and earn up to 50% weekly returns.</p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Get Started</a>
                        <a href="{{ url('/investment-plans') }}" class="btn btn-outline-light btn-lg">View Plans</a>
                    </div>
                </div>
                <div class="col-lg-6 slide-in-right">
                    <div class="hero-image-wrapper">
                        <img src="/assets/images/hero-meeting.jpg" alt="Professional Investment Meeting" class="img-fluid rounded-3 shadow-lg hero-image">
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
        </div>
        <style>
            .hero-section {
                position: relative;
                overflow: hidden;
                padding: 100px 0;
                background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-bg) 100%);
            }
            .hero-section::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url('/assets/images/grid-pattern.png') repeat;
                opacity: 0.1;
            }
            .hero-image-wrapper {
                position: relative;
                padding: 2rem;
            }
            .hero-image {
                max-width: 100%;
                height: auto;
                filter: drop-shadow(0 0 20px rgba(0, 255, 136, 0.2));
                transition: transform 0.3s ease;
            }
            .hero-image:hover {
                transform: scale(1.02);
            }
            .floating-elements {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
            }
            .float-element {
                position: absolute;
                animation: float 6s ease-in-out infinite;
            }
            .float-element.bitcoin {
                top: 10%;
                left: 10%;
                animation-delay: 0s;
            }
            .float-element.ethereum {
                top: 30%;
                right: 15%;
                animation-delay: 2s;
            }
            .float-element.chart {
                bottom: 20%;
                left: 20%;
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
                    padding: 60px 0;
                }
                .hero-image-wrapper {
                    margin-top: 2rem;
                }
                .d-flex {
                    justify-content: center;
                }
            }
        </style>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5 fade-in">Why Choose Gobitrage?</h2>
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
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-4 fw-bold mb-3 fade-in">Investment Plans</h2>
                <p class="lead fade-in" style="animation-delay: 0.2s;">Choose the perfect investment plan that suits your goals</p>
            </div>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="card hover-lift fade-in">
                        <div class="card-body text-center p-4">
                            <div class="icon-box mb-4">
                                <i class="bi bi-coin-stack text-primary"></i>
                            </div>
                            <h3 class="card-title">Basic Plan</h3>
                            <div class="price-tag mb-4">
                                <h4 class="mb-0">$20 - $399</h4>
                                <p class="text-muted mb-0">Profit: 8%</p>
                            </div>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Minimum Investment: $20</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Maximum Investment: $399</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Profit: 8%</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Duration: 24 hours</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Referral Commission: 5%</li>
                            </ul>
                            <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card hover-lift fade-in" style="animation-delay: 0.2s;">
                        <div class="card-body text-center p-4">
                            <div class="icon-box mb-4">
                                <i class="bi bi-gem text-primary"></i>
                            </div>
                            <h3 class="card-title">Standard Plan</h3>
                            <div class="price-tag mb-4">
                                <h4 class="mb-0">$400 - $3,999</h4>
                                <p class="text-muted mb-0">Profit: 15%</p>
                            </div>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Minimum Investment: $400</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Maximum Investment: $3,999</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Profit: 15%</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Duration: 48 hours</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Referral Commission: 7%</li>
                            </ul>
                            <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card hover-lift fade-in" style="animation-delay: 0.4s;">
                        <div class="card-body text-center p-4">
                            <div class="icon-box mb-4">
                                <i class="bi bi-crown text-primary"></i>
                            </div>
                            <h3 class="card-title">Premium Plan</h3>
                            <div class="price-tag mb-4">
                                <h4 class="mb-0">$4,000 - $7,999</h4>
                                <p class="text-muted mb-0">Profit: 20%</p>
                            </div>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Minimum Investment: $4,000</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Maximum Investment: $7,999</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Profit: 20%</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Duration: 72 hours</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Referral Commission: 10%</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Featured Badge Enabled</li>
                            </ul>
                            <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card hover-lift fade-in" style="animation-delay: 0.6s;">
                        <div class="card-body text-center p-4">
                            <div class="icon-box mb-4">
                                <i class="bi bi-trophy text-primary"></i>
                            </div>
                            <h3 class="card-title">VIP Plan</h3>
                            <div class="price-tag mb-4">
                                <h4 class="mb-0">$8,000+</h4>
                                <p class="text-muted mb-0">Profit: 25%</p>
                            </div>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Minimum Investment: $8,000</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Maximum Investment: No limit</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Profit: 25%</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Duration: 76 hours</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Referral Commission: 12%</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Featured Badge Enabled</li>
                            </ul>
                            <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5 fade-in">What Our Investors Say</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 slide-in-left">
                        <div class="card-body">
                            <p class="card-text">"I've been investing with Gobitrage for over a year now, and the returns have been consistently excellent. The support team is always helpful and responsive."</p>
                            <footer class="blockquote-footer">John Doe, Professional Investor</footer>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 slide-in-left" style="animation-delay: 0.2s;">
                        <div class="card-body">
                            <p class="card-text">"The platform is user-friendly and secure. I started with a small investment and gradually increased it as I saw the consistent returns."</p>
                            <footer class="blockquote-footer">Jane Smith, Business Owner</footer>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 slide-in-left" style="animation-delay: 0.4s;">
                        <div class="card-body">
                            <p class="card-text">"Gobitrage has transformed my investment portfolio. The weekly returns are impressive, and the withdrawal process is smooth."</p>
                            <footer class="blockquote-footer">Mike Johnson, Entrepreneur</footer>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="mb-4 fade-in">Ready to Start Your Investment Journey?</h2>
            <p class="lead mb-4 fade-in" style="animation-delay: 0.2s;">Join thousands of successful investors who trust Gobitrage with their investments.</p>
            <a href="{{ route('register') }}" class="btn btn-light btn-lg fade-in" style="animation-delay: 0.4s;">Create Account Now</a>
        </div>
    </section>
</x-template.guest>

<style>
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
        color: var(--secondary-color) !important;
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
</style>
