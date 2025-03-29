<x-template.guest>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 slide-in-left">
                    <h1 class="display-4 fw-bold mb-4">About Gobitrage</h1>
                    <p class="lead mb-4">Your trusted partner in cryptocurrency investment since 2020. We combine expertise, innovation, and security to deliver exceptional returns for our investors.</p>
                </div>
                <div class="col-lg-6 slide-in-right">
                    <div class="hero-image-wrapper">
                        <img src="/assets/images/ethereum-trading.jpg" alt="Ethereum Trading" class="img-fluid rounded-3 shadow-lg hero-image">
                        <div class="floating-elements">
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
                background: linear-gradient(135deg, var(--primary-color) 0%, #0a1f3c 100%);
            }
            .hero-section::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url('/assets/images/grid-pattern.png') repeat;
                opacity: 0.05;
            }
            .hero-image-wrapper {
                position: relative;
                padding: 2rem;
            }
            .hero-image {
                max-width: 100%;
                height: auto;
                filter: drop-shadow(0 0 30px rgba(78, 132, 255, 0.3));
                transition: transform 0.3s ease;
                border-radius: 15px;
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
                pointer-events: none;
            }
            .float-element {
                position: absolute;
                animation: float 6s ease-in-out infinite;
            }
            .float-element.ethereum {
                top: 10%;
                right: 15%;
                animation-delay: 0s;
            }
            .float-element.chart {
                bottom: 20%;
                left: 15%;
                animation-delay: 2s;
            }
            .float-icon {
                width: 60px;
                height: 60px;
                filter: drop-shadow(0 0 15px rgba(78, 132, 255, 0.4));
            }
            @keyframes float {
                0% { transform: translateY(0px) rotate(0deg); }
                50% { transform: translateY(-20px) rotate(5deg); }
                100% { transform: translateY(0px) rotate(0deg); }
            }
        </style>
    </section>

    <!-- Our Story Section -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="position-relative mb-4">
                        <img src="/assets/images/ethereum-reflection.jpg" alt="Ethereum Trading" class="img-fluid rounded-3 shadow-lg story-image">
                        <div class="image-overlay"></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h2 class="display-5 fw-bold mb-4 fade-in">Our Story</h2>
                    <p class="lead mb-4 fade-in" style="animation-delay: 0.2s;">Founded in 2020, Gobitrage emerged from a vision to democratize cryptocurrency investment opportunities. Our team of experienced traders and financial experts came together to create a platform that would make crypto investment accessible to everyone.</p>
                    <p class="mb-4 fade-in" style="animation-delay: 0.3s;">We started with a simple mission: to provide secure, transparent, and profitable investment opportunities in the cryptocurrency market. Today, we're proud to serve thousands of investors worldwide, helping them achieve their financial goals through our innovative investment strategies.</p>
                </div>
            </div>
        </div>
        <style>
            .story-image {
                transition: transform 0.3s ease;
                max-width: 100%;
                height: auto;
            }
            .story-image:hover {
                transform: scale(1.02);
            }
            .image-overlay {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(135deg, rgba(var(--primary-rgb), 0.1) 0%, rgba(10, 31, 60, 0.1) 100%);
                border-radius: 15px;
                pointer-events: none;
            }
        </style>
    </section>

    <!-- Our Mission Section -->
    <section class="py-5 bg-gradient">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="card hover-lift fade-in">
                        <div class="card-body p-4">
                            <h2 class="h3 mb-4">Our Mission</h2>
                            <p class="mb-4">To provide accessible, secure, and profitable cryptocurrency investment opportunities while maintaining the highest standards of transparency and customer service.</p>
                            <ul class="list-unstyled">
                                <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>Secure Investment Platform</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>Transparent Operations</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>Expert Trading Team</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>24/7 Customer Support</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h2 class="display-5 fw-bold mb-4 fade-in">Why Choose Us?</h2>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm hover-lift fade-in">
                                <div class="card-body p-4">
                                    <div class="icon-box mb-3">
                                        <i class="bi bi-shield-lock text-primary"></i>
                                    </div>
                                    <h3 class="h5">Secure Platform</h3>
                                    <p class="text-muted mb-0">State-of-the-art security measures to protect your investments.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm hover-lift fade-in" style="animation-delay: 0.2s;">
                                <div class="card-body p-4">
                                    <div class="icon-box mb-3">
                                        <i class="bi bi-graph-up text-primary"></i>
                                    </div>
                                    <h3 class="h5">Proven Returns</h3>
                                    <p class="text-muted mb-0">Consistent and reliable returns through expert trading strategies.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm hover-lift fade-in" style="animation-delay: 0.4s;">
                                <div class="card-body p-4">
                                    <div class="icon-box mb-3">
                                        <i class="bi bi-headset text-primary"></i>
                                    </div>
                                    <h3 class="h5">24/7 Support</h3>
                                    <p class="text-muted mb-0">Dedicated support team always ready to assist you.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm hover-lift fade-in" style="animation-delay: 0.6s;">
                                <div class="card-body p-4">
                                    <div class="icon-box mb-3">
                                        <i class="bi bi-globe2 text-primary"></i>
                                    </div>
                                    <h3 class="h5">Global Reach</h3>
                                    <p class="text-muted mb-0">Serving investors from over 50 countries worldwide.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center display-5 fw-bold mb-5 fade-in">Our Expert Team</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card hover-lift fade-in">
                        <div class="card-body text-center p-4">
                            <div class="team-image mb-4">
                                <img src="/assets/images/team/ceo.jpg" alt="CEO" class="rounded-circle">
                            </div>
                            <h3 class="h4">John Smith</h3>
                            <p class="text-muted mb-3">CEO & Founder</p>
                            <p class="mb-0">15+ years of experience in cryptocurrency trading and investment management.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card hover-lift fade-in" style="animation-delay: 0.2s;">
                        <div class="card-body text-center p-4">
                            <div class="team-image mb-4">
                                <img src="/assets/images/team/cto.jpg" alt="CTO" class="rounded-circle">
                            </div>
                            <h3 class="h4">Sarah Johnson</h3>
                            <p class="text-muted mb-3">Chief Technology Officer</p>
                            <p class="mb-0">Expert in blockchain technology and cybersecurity implementation.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card hover-lift fade-in" style="animation-delay: 0.4s;">
                        <div class="card-body text-center p-4">
                            <div class="team-image mb-4">
                                <img src="/assets/images/team/trader.jpg" alt="Lead Trader" class="rounded-circle">
                            </div>
                            <h3 class="h4">Michael Chen</h3>
                            <p class="text-muted mb-3">Lead Trading Strategist</p>
                            <p class="mb-0">Specialized in cryptocurrency market analysis and trading strategies.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="mb-4 fade-in">Ready to Join Our Success Story?</h2>
            <p class="lead mb-4 fade-in" style="animation-delay: 0.2s;">Start your investment journey with Gobitrage today and become part of our growing community of successful investors.</p>
            <a href="{{ route('register') }}" class="btn btn-light btn-lg fade-in" style="animation-delay: 0.4s;">Create Account Now</a>
        </div>
    </section>

    <style>
        .bg-gradient {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-bg) 100%);
            color: var(--text-color);
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
        .team-image {
            width: 150px;
            height: 150px;
            margin: 0 auto;
            overflow: hidden;
            border-radius: 50%;
            border: 3px solid var(--secondary-color);
        }
        .team-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
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
</x-template.guest>
