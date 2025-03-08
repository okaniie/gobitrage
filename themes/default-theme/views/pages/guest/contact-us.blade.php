<x-template.guest>
    <x-general.page-banner>Contact Us</x-general.page-banner>
    <section class="what-we-do-area bg_cover pb-120 hide-overflow"
        style="background-image: url(assets/images/what-we-do-bg.jpg);">
        <div class="container">
            <h4>Get In Touch</h4>
            <p>If you need advice or have any question in mind or technical assistance, do not hesitate to contact our
                specialists.</p>
            <p><strong>Email Address:</strong> {{ config('display.email') }}</p>
            <p>&nbsp;</p>
            <p><strong>Address:</strong> {{ config('display.address') }}</p>
        </div>
    </section>
</x-template.guest>
