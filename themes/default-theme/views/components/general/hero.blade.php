<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 fade-in">
                <h1 class="display-4 fw-bold mb-4">Secure Your Financial Future with Crypto Investments</h1>
                <p class="lead mb-4">Join thousands of successful investors who trust our platform for their cryptocurrency investments. Start earning today with our proven investment strategies.</p>
                <div class="d-flex gap-3">
                    <a href="{{ url('/register') }}" class="btn btn-primary btn-lg">Get Started</a>
                    <a href="{{ url('/about-us') }}" class="btn btn-outline-light btn-lg">Learn More</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="position-relative">
                    <div class="hero-image-wrapper">
                        <img src="/assets/images/crypto-trading.svg" alt="Crypto Trading" class="img-fluid hero-image slide-in-right">
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
    </div>
</section>

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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, {
        threshold: 0.1
    });

    document.querySelectorAll('.fade-in, .slide-in-right').forEach((el) => observer.observe(el));
});
</script> 