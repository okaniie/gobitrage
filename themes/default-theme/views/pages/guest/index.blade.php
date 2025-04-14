<x-template.guest>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="container flex flex-col">
            <div class="working-since">WORKING SINCE 2020</div>
            <div class="flex align-items-center min-vh-50">
                <div class="col-lg-6 slide-in-left basis-1/2">
                    <h1 class="text-6xl fw-bold mb-3 text-white font-bold">Welcome to Gobitrage</h1>
                    <p class=" mb-4 text-white/75 text-xl">Your trusted partner in cryptocurrency investment. Start your journey with as little as $20 and earn up to 50% weekly returns.</p>
                    <div class="justify-start mb-4 text-2xl flex gap-3">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg btn-primary p-2 ml-2 border rounded-sm">Get Started</a>
                        <a href="{{ url('/investment-plans') }}" class="btn btn-outline-light btn-lg p-2 ml-2 border rounded-sm hover:bg-white">View Plans</a>
                    </div>
                    <div class="flex gap-3 text-xl">
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
                <div class="basis-1/2">
                    <div class="floating-elements ">
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
                background: url('/assets/images/Businessvd.mp4') no-repeat center center;
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
                height: 50%;
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

        .container {
            margin: 0 auto;
        }
        .row {
            display: flex;
            align-items: center;
        }
        .col-left {
            width: 600px;
            padding-right: 20px;
        }
        .col-right {
            padding-left: 20px;
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
            .working-since {
                backdrop-filter: blur(5px);
                padding: 6px 16px;
                color: white;
                display: inline-block;
                margin-bottom: 1.5rem;
                font-weight: 500;
                letter-spacing: 1px;
                font-size: 0.9rem;
            }
        </style>
    </section>

    <!-- CTA Section -->
    <section class=" text-white bg-blue-600">
        <div class="container text-center py-10 flex flex-col gap-3 items-center">
            <h2 class="fade-in text-4xl">Ready to Start Your Investment Journey?</h2>
            <p class="lead fade-in text-2xl" style="animation-delay: 0.2s;">Join thousands of successful investors who trust Gobitrage with their investments.</p>
            <a href="{{ route('register') }}" class=" btn-light bg-white text-black text-xl rounded-md p-4 w-fit fade-in" style="animation-delay: 0.4s;">Create Account Now</a>
        </div>
    </section>

    <!-- Cryptocurrencies Section -->
    <section class="py-5 crypto-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="text-white text-2xl font-bold">WE WORK WITH E-CURRENCIES</h2>
                <p class="text-gray-500">Fast and secure transactions</p>
            </div>
            <div class="grid grid-cols-3 gap-5">
                <div class="mb-4">
                    <div class="crypto-card flex flex-col items-center">
                        <img src="/assets/images/btc.svg" alt="Bitcoin" class="crypto-icon">
                        <h4>Bitcoin</h4>
                        @auth
                            <a href="{{ route('user.deposits') }}" class="crypto-btn">Deposit Now</a>
                        @else
                            <a href="{{ route('register') }}" class="crypto-btn">Deposit Now</a>
                        @endauth
                    </div>
                </div>
                <div class=" mb-4">
                    <div class="crypto-card flex flex-col items-center">
                        <img src="/assets/images/usdt.svg" alt="USDT" class="crypto-icon">
                        <h4>USDT</h4>
                        @auth
                            <a href="{{ route('user.deposits') }}" class="crypto-btn">Deposit Now</a>
                        @else
                            <a href="{{ route('register') }}" class="crypto-btn">Deposit Now</a>
                        @endauth
                    </div>
                </div>
                <div class=" mb-4">
                    <div class="crypto-card flex flex-col items-center">
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
        </style>
    </section>

    <!-- Investment Plans Section -->
    <section class="py-5 investment-plans">
        <div class="container">
            <div class="text-center font-bold text-white mb-5">
                <h2 class="display-4 mb-3 text-6xl fade-in">Investment Plans</h2>
                <p class="lead text-2xl  fade-in" style="animation-delay: 0.2s;">Choose the perfect investment plan that suits your goals</p>
            </div>
            <div class="grid grid-cols-4 gap-2">
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
                                    <h4 class="mb-0">$20 - $1,999</h4>
                                    <p class="text-muted mb-0">Profit: 8%</p>
                                </div>
                                <ul class="list-unstyled mb-3">
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Min: $20</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Max: $1,999</li>
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
                        <a href="{{ route('user.deposits') }}?plan=premium" class="text-decoration-none">
                    @else
                        <a href="{{ route('register') }}" class="text-decoration-none">
                    @endauth
                        <div class="card hover-lift fade-in h-100" style="animation-delay: 0.2s;">
                            <div class="card-body text-center p-3">
                                <div class="icon-box mb-3">
                                    <i class="bi bi-diamond-fill text-primary"></i>
                                </div>
                                <h3 class="card-title">Premium Plan</h3>
                                <div class="price-tag mb-3">
                                    <h4 class="mb-0">$2,000 - $5,999</h4>
                                    <p class="text-muted mb-0">Profit: 20%</p>
                                </div>
                                <ul class="list-unstyled mb-3">
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Min: $2,000</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Max: $5,999</li>
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
                        <div class="card hover-lift fade-in h-100" style="animation-delay: 0.4s;">
                            <div class="card-body text-center p-3">
                                <div class="icon-box mb-3">
                                    <i class="bi bi-trophy text-primary"></i>
                                </div>
                                <h3 class="card-title">VIP Plan</h3>
                                <div class="price-tag mb-3">
                                    <h4 class="mb-0">$6,000 - $9,999</h4>
                                    <p class="text-muted mb-0">Profit: 25%</p>
                                </div>
                                <ul class="list-unstyled mb-3">
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Min: $6,000</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Max: $9,999</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Profit: 25%</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>76 hours</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>12% Referral</li>
                                </ul>
                                <div class="btn btn-primary">Invest Now</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    @auth
                        <a href="{{ route('user.deposits') }}?plan=elite" class="text-decoration-none">
                    @else
                        <a href="{{ route('register') }}" class="text-decoration-none">
                    @endauth
                        <div class="card hover-lift fade-in h-100" style="animation-delay: 0.6s;">
                            <div class="card-body text-center p-3">
                                <div class="icon-box mb-3">
                                    <i class="bi bi-crown text-primary"></i>
                                </div>
                                <h3 class="card-title">Elite Plan</h3>
                                <div class="price-tag mb-3">
                                    <h4 class="mb-0">$10,000+</h4>
                                    <p class="text-muted mb-0">Profit: 30%</p>
                                </div>
                                <ul class="list-unstyled mb-3">
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Min: $10,000</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Max: No limit</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Profit: 30%</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>96 hours</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>15% Referral</li>
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
            <div class="text-center font-bold text-white mb-5">
                <h2 class="display-4 text-6xl mb-3 fade-in">What Our Investors Say</h2>
                <p class="lead text-2xl fade-in" style="animation-delay: 0.2s;">Join thousands of satisfied investors who trust Gobitrage</p>
            </div>
            <div class="grid grid-cols-3 gap-3">
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
                                    <h5>John Glass</h5>
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
                          
