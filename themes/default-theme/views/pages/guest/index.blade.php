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
                    <img src="/assets/images/hero-image.png" alt="Gobitrage Hero" class="img-fluid">
                </div>
            </div>
        </div>
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

    <!-- Investment Plans Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 fade-in">Investment Plans</h2>
            <div class="row">
                @foreach($plans as $plan)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 scale-in" style="animation-delay: {{ $loop->index * 0.2 }}s;">
                            <div class="card-body text-center">
                                <h3 class="card-title">{{ $plan->title }}</h3>
                                <h4 class="text-primary mb-4">${{ number_format($plan->minimum, 2) }} - ${{ $plan->maximum ? number_format($plan->maximum, 2) : 'Unlimited' }}</h4>
                                <ul class="list-unstyled">
                                    <li class="mb-2">{{ $plan->percentage }}% ROI</li>
                                    <li class="mb-2">Duration: {{ $plan->duration }} {{ Str::plural($plan->duration_type, $plan->duration) }}</li>
                                    <li class="mb-2">{{ $plan->referral_percentage }}% Referral Bonus</li>
                                    <li class="mb-2">24/7 Support</li>
                                </ul>
                                <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
                            </div>
                            @if($plan->has_badge)
                                <div class="position-absolute top-0 start-100 translate-middle badge bg-success">
                                    Featured
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
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
