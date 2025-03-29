<x-template.guest>
    <!-- Investment Plans Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Investment Plans</h2>
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

    <!-- Call to Action -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="mb-4 fade-in">Ready to Start Your Investment Journey?</h2>
            <p class="lead mb-4 fade-in" style="animation-delay: 0.2s;">Join thousands of successful investors who trust us with their investments.</p>
            <a href="{{ route('register') }}" class="btn btn-light btn-lg fade-in" style="animation-delay: 0.4s;">Create Account Now</a>
        </div>
    </section>
</x-template.guest> 