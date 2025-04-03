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

        .container {
            width: 1200px;
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
            width: 600px;
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
