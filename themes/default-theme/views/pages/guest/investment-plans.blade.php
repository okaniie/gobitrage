<x-template.guest>
    <!-- Investment Plans Section -->
    <section class="py-5 investment-plans">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-4 fw-bold mb-3 fade-in">Investment Plans</h2>
                <p class="lead fade-in" style="animation-delay: 0.2s;">Choose the perfect investment plan that suits your goals</p>
            </div>
            <div class="row g-4">
                <div class="col-md-3">
                    @auth
                        <a href="{{ route('user.deposits') }}?plan=basic" class="text-decoration-none">
                    @else
                        <a href="{{ route('register') }}" class="text-decoration-none">
                    @endauth
                        <div class="card hover-lift fade-in h-100">
                            <div class="card-body text-center p-4">
                                <div class="icon-box mb-4">
                                    <i class="bi bi-piggy-bank text-primary display-4"></i>
                                </div>
                                <h3 class="card-title">Basic Plan</h3>
                                <div class="price-tag mb-4">
                                    <h4 class="mb-0">$20 - $1,999</h4>
                                    <p class="text-muted mb-0">Profit: 8%</p>
                                </div>
                                <ul class="list-unstyled mb-4">
                                    <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>Min: $20</li>
                                    <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>Max: $1,999</li>
                                    <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>Profit: 8%</li>
                                    <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>24 hours</li>
                                    <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>5% Referral</li>
                                </ul>
                                <div class="btn btn-primary btn-lg">Invest Now</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    @auth
                        <a href="{{ route('user.deposits') }}?plan=premium" class="text-decoration-none">
                    @else
                        <a href="{{ route('register') }}" class="text-decoration-none">
                    @endauth
                        <div class="card hover-lift fade-in h-100" style="animation-delay: 0.2s;">
                            <div class="card-body text-center p-4">
                                <div class="icon-box mb-4">
                                    <i class="bi bi-diamond-fill text-primary display-4"></i>
                                </div>
                                <h3 class="card-title">Premium Plan</h3>
                                <div class="price-tag mb-4">
                                    <h4 class="mb-0">$2,000 - $5,999</h4>
                                    <p class="text-muted mb-0">Profit: 20%</p>
                                </div>
                                <ul class="list-unstyled mb-4">
                                    <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>Min: $2,000</li>
                                    <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>Max: $5,999</li>
                                    <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>Profit: 20%</li>
                                    <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>72 hours</li>
                                    <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>10% Referral</li>
                                </ul>
                                <div class="btn btn-primary btn-lg">Invest Now</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    @auth
                        <a href="{{ route('user.deposits') }}?plan=vip" class="text-decoration-none">
                    @else
                        <a href="{{ route('register') }}" class="text-decoration-none">
                    @endauth
                        <div class="card hover-lift fade-in h-100" style="animation-delay: 0.4s;">
                            <div class="card-body text-center p-4">
                                <div class="icon-box mb-4">
                                    <i class="bi bi-trophy text-primary display-4"></i>
                                </div>
                                <h3 class="card-title">VIP Plan</h3>
                                <div class="price-tag mb-4">
                                    <h4 class="mb-0">$6,000 - $9,999</h4>
                                    <p class="text-muted mb-0">Profit: 25%</p>
                                </div>
                                <ul class="list-unstyled mb-4">
                                    <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>Min: $6,000</li>
                                    <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>Max: $9,999</li>
                                    <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>Profit: 25%</li>
                                    <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>76 hours</li>
                                    <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>12% Referral</li>
                                </ul>
                                <div class="btn btn-primary btn-lg">Invest Now</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    @auth
                        <a href="{{ route('user.deposits') }}?plan=elite" class="text-decoration-none">
                    @else
                        <a href="{{ route('register') }}" class="text-decoration-none">
                    @endauth
                        <div class="card hover-lift fade-in h-100" style="animation-delay: 0.6s;">
                            <div class="card-body text-center p-4">
                                <div class="icon-box mb-4">
                                    <i class="bi bi-crown text-primary display-4"></i>
                                </div>
                                <h3 class="card-title">Elite Plan</h3>
                                <div class="price-tag mb-4">
                                    <h4 class="mb-0">$10,000+</h4>
                                    <p class="text-muted mb-0">Profit: 30%</p>
                                </div>
                                <ul class="list-unstyled mb-4">
                                    <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>Min: $10,000</li>
                                    <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>Max: No limit</li>
                                    <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>Profit: 30%</li>
                                    <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>96 hours</li>
                                    <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>15% Referral</li>
                                </ul>
                                <div class="btn btn-primary btn-lg">Invest Now</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5 bg-gradient text-white">
        <div class="container text-center">
            <h2 class="mb-4 fade-in">Ready to Start Your Investment Journey?</h2>
            <p class="lead mb-4 fade-in" style="animation-delay: 0.2s;">Join thousands of successful investors who trust us with their investments.</p>
            <a href="{{ route('register') }}" class="btn btn-light btn-lg fade-in" style="animation-delay: 0.4s;">Create Account Now</a>
        </div>
    </section>

    <style>
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
            color: var(--dark-bg);
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
            .investment-plans {
                padding: 3rem 0;
            }
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
            .container {
                width: 100% !important;
                padding-right: 15px;
                padding-left: 15px;
            }
            .row {
                display: grid;
                grid-template-columns: 1fr;
                gap: 20px;
                margin: 0;
            }
            .col-md-3 {
                width: 100%;
                flex: 0 0 100%;
                max-width: 100%;
                padding: 0;
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
    </style>
</x-template.guest> 