<x-template.guest>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 slide-in-left">
                    <h1 class="display-4 fw-bold mb-4">Frequently Asked Questions</h1>
                    <p class="lead mb-4">Find answers to common questions about our investment platform and services.</p>
                </div>
                <div class="col-lg-6 slide-in-right">
                    <div class="hero-image-wrapper">
                        <img src="/assets/images/faq-hero.jpg" alt="FAQ Support" class="img-fluid rounded-3 shadow-lg hero-image">
                        <div class="floating-elements">
                            <div class="float-element bitcoin">
                                <img src="/assets/images/bitcoin.svg" alt="Bitcoin" class="float-icon">
                            </div>
                            <div class="float-element ethereum">
                                <img src="/assets/images/ethereum.svg" alt="Ethereum" class="float-icon">
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
                color: #ffffff;
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
            .float-icon {
                width: 60px;
                height: 60px;
                filter: drop-shadow(0 0 10px rgba(0, 255, 136, 0.3));
            }
            @keyframes float {
                0% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
                100% { transform: translateY(0px); }
            }
            .hero-section .lead {
                color: rgba(255, 255, 255, 0.9);
            }
        </style>
    </section>

    <!-- FAQ Section -->
    <section class="py-5">
        <div class="container">
            <div class="row mt-40">
                <div class="col-md-6 col-sm-6 col-12">
                    <div class="pr-30-md">
                        <div class="card hover-lift fade-in mb-4">
                            <div class="card-body p-4">
                                <div class="accordion" id="accordionLeft">
                                    <div class="accordion-item border-0">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ac_col1">
                                                What is Gobitrage?
                                            </button>
                                        </h2>
                                        <div id="ac_col1" class="accordion-collapse collapse" data-bs-parent="#accordionLeft">
                                            <div class="accordion-body">
                                                Gobitrage is founded by a team of professional Forex & Crypto traders who know exactly what it takes to earn the most from capital market. Our company provides a full investment service focused on the Forex and cryptocurrency trading market. Each trader in our company has more than 7 years of trading experience and successful trading records, as we know that is the exact point that support our company stability and profitability.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item border-0">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ac_col2">
                                                Is Gobitrage officially registered?
                                            </button>
                                        </h2>
                                        <div id="ac_col2" class="accordion-collapse collapse" data-bs-parent="#accordionLeft">
                                            <div class="accordion-body">
                                                Yes. Gobitrage is a legally registered investment company incorporated and headquartered in London, England. <a href="assets/images/investorm-certificate.png" target="_blank" class="text-primary">Click Here to view our registration.</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item border-0">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ac_col3">
                                                Who can create an account with Gobitrage?
                                            </button>
                                        </h2>
                                        <div id="ac_col3" class="accordion-collapse collapse" data-bs-parent="#accordionLeft">
                                            <div class="accordion-body">
                                                Any individual or legitimate entity can avail our services. However, you need to be of legal age in your jurisdiction in order to create an account with us.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item border-0">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ac_col4">
                                                How do I create my account with Gobitrage?
                                            </button>
                                        </h2>
                                        <div id="ac_col4" class="accordion-collapse collapse" data-bs-parent="#accordionLeft">
                                            <div class="accordion-body">
                                                Registration process is very easy and will take a few moments to complete. Simply click "Register" button on the top right of our website and fill in all the required fields.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item border-0">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ac_col5">
                                                Can I have more than one account with you?
                                            </button>
                                        </h2>
                                        <div id="ac_col5" class="accordion-collapse collapse" data-bs-parent="#accordionLeft">
                                            <div class="accordion-body">
                                                Yes, you can.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item border-0">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ac_col6">
                                                What do I need to start trading or investing with Gobitrage?
                                            </button>
                                        </h2>
                                        <div id="ac_col6" class="accordion-collapse collapse" data-bs-parent="#accordionLeft">
                                            <div class="accordion-body">
                                                First of all, you need to register a new account, make a deposit of at least $20 through the popular payment systems before proceeding with option trading or investment.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item border-0">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ac_col7">
                                                How many times can a user make deposits into their account?
                                            </button>
                                        </h2>
                                        <div id="ac_col7" class="accordion-collapse collapse" data-bs-parent="#accordionLeft">
                                            <div class="accordion-body">
                                                A user can make deposits in his or her account as and when they want. There is no limitation on the number of deposits that a user can make into their account.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-12">
                    <div class="pr-30-md">
                        <div class="card hover-lift fade-in mb-4">
                            <div class="card-body p-4">
                                <div class="accordion" id="accordionRight">
                                    <div class="accordion-item border-0">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ac_col8">
                                                What payment methods can I use to make a deposit?
                                            </button>
                                        </h2>
                                        <div id="ac_col8" class="accordion-collapse collapse" data-bs-parent="#accordionRight">
                                            <div class="accordion-body">
                                                Currently we accept Bitcoin, Ethereum and BitcoinCash.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item border-0">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ac_col9">
                                                What is the Minimum / Maximum amount allowed to deposit?
                                            </button>
                                        </h2>
                                        <div id="ac_col9" class="accordion-collapse collapse" data-bs-parent="#accordionRight">
                                            <div class="accordion-body">
                                                As for investment and contract plans, the minimum and maximum investment capital is specified on each plan.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item border-0">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ac_col10">
                                                Can I make reinvestments?
                                            </button>
                                        </h2>
                                        <div id="ac_col10" class="accordion-collapse collapse" data-bs-parent="#accordionRight">
                                            <div class="accordion-body">
                                                Yes, you can reinvest.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item border-0">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ac_col11">
                                                Do I get my investment principal back?
                                            </button>
                                        </h2>
                                        <div id="ac_col11" class="accordion-collapse collapse" data-bs-parent="#accordionRight">
                                            <div class="accordion-body">
                                                Yes, on expiration of the activated portfolio, the capital will be returned to your trading account.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item border-0">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ac_col12">
                                                What is the minimum amount for withdrawal?
                                            </button>
                                        </h2>
                                        <div id="ac_col12" class="accordion-collapse collapse" data-bs-parent="#accordionRight">
                                            <div class="accordion-body">
                                                The minimum withdrawal amount is $20.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item border-0">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ac_col13">
                                                Are there any fees to withdraw my funds?
                                            </button>
                                        </h2>
                                        <div id="ac_col13" class="accordion-collapse collapse" data-bs-parent="#accordionRight">
                                            <div class="accordion-body">
                                                There are no any hidden fees to withdraw your funds.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item border-0">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ac_col14">
                                                Do you have an affiliate program?
                                            </button>
                                        </h2>
                                        <div id="ac_col14" class="accordion-collapse collapse" data-bs-parent="#accordionRight">
                                            <div class="accordion-body">
                                                Yes, you will get 5% referral commission on your referrals.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .hover-lift {
            transition: all 0.3s ease;
            background: #ffffff;
            border: 1px solid rgba(0, 255, 136, 0.1);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
        }
        .hover-lift:hover {
            transform: translateY(-10px);
            box-shadow: 0 1rem 3rem rgba(0, 255, 136, 0.2) !important;
        }
        .accordion-button {
            background: transparent;
            color: #333;
            font-weight: 500;
            padding: 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .accordion-button:not(.collapsed) {
            background: rgba(0, 255, 136, 0.1);
            color: var(--secondary-color);
        }
        .accordion-button:focus {
            box-shadow: none;
            border-color: rgba(0, 255, 136, 0.2);
        }
        .accordion-button::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%2300ff88'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        }
        .accordion-body {
            color: #666;
            padding: 1rem;
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
        .text-primary {
            color: var(--secondary-color) !important;
        }
        .text-primary:hover {
            color: var(--accent-color) !important;
        }
    </style>
</x-template.guest>
