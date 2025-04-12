<footer class="footer">
    <div class="p-10">
        <div class="flex">
            <div class="basis-1/3">
                <h5>About Gobitrage</h5>
                <p>Gobitrage is a fully certified, licensed company offering investors around the globe reliable investment schedules with minimum investment as low as $20.</p>
            </div>
            <div class="basis-1/3">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/about-us') }}">About Us</a></li>
                    <li><a href="{{ url('/investment-plans') }}">Investment Plans</a></li>
                    <li><a href="{{ url('/faqs') }}">FAQs</a></li>
                    <li><a href="{{ url('/contact-us') }}">Contact Us</a></li>
                </ul>
            </div>
            <div class="basis-1/3">
                <h5>Contact Us</h5>
                <ul class="list-unstyled">
                    <li><i class="bi bi-envelope"></i> support@gobitrage.com</li>
                    <li><i class="bi bi-telephone"></i> +1(415)7547284</li>
                    <li><i class="bi bi-geo-alt"></i> 26-28 Cornhill, London, EC2V 511A, United Kingdom</li>
                </ul>
            </div>
        </div>
        <hr class="my-4">
        <div class="row">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-0">&copy; {{ date('Y') }} Gobitrage. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <a href="#" class="text-muted me-3">Privacy Policy</a>
                <a href="#" class="text-muted">Terms & Conditions</a>
            </div>
        </div>
    </div>
</footer>
