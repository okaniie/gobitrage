<x-template.user title="Dashboard" slug="dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <!-- TradingView Widget BEGIN -->
    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
    
    <div class="dashboard-wrapper">
        <div class="container-fluid py-4">
            <div class="row">
                <!-- Account Stats Cards -->
                <div class="col-md-3 mb-4">
                    <div class="card bg-dark text-white">
                        <div class="card-body">
                            <h5 class="text-muted mb-2">INVESTMENT</h5>
                            <h3 class="mb-0">${{ number_format($total_deposit, 2) }}</h3>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 mb-4">
                    <div class="card bg-dark text-white">
                        <div class="card-body">
                            <h5 class="text-muted mb-2">TOTAL BALANCE</h5>
                            <h3 class="mb-0">${{ number_format($total_balance, 2) }}</h3>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 mb-4">
                    <div class="card bg-dark text-white">
                        <div class="card-body">
                            <h5 class="text-muted mb-2">REFERRAL BONUS</h5>
                            <h3 class="mb-0">${{ number_format($referral_commission, 2) }}</h3>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 mb-4">
                    <div class="card bg-dark text-white">
                        <div class="card-body">
                            <h5 class="text-muted mb-2">ACCOUNT STATUS</h5>
                            <h3 class="mb-0">{{ Auth::user()->status ? 'Active' : 'Inactive' }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="btn-group w-100">
                        <a href="{{ route('user.profile') }}" class="btn btn-dark">Account</a>
                        <a href="{{ route('user.deposits') }}" class="btn btn-dark">Make Deposit</a>
                        <a href="{{ route('user.withdrawals') }}" class="btn btn-dark">Withdraw Funds</a>
                        <a href="{{ route('user.profile') }}" class="btn btn-dark">Settings</a>
                    </div>
                </div>
            </div>

            <!-- Trading Chart -->
            <div class="card bg-dark mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Live Trading Chart</h5>
                    <button class="btn btn-sm btn-outline-secondary" onclick="toggleFullscreen(this)">
                        <i class="fas fa-expand"></i>
                    </button>
                </div>
                <div class="card-body p-0">
                    <div id="tradingview_widget" class="trading-chart"></div>
                </div>
            </div>

            <!-- Cryptocurrency Market -->
            <div class="card bg-dark">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Cryptocurrency Market</h5>
                    <button class="btn btn-sm btn-outline-secondary" onclick="toggleFullscreen(this)">
                        <i class="fas fa-expand"></i>
                    </button>
                </div>
                <div class="card-body p-0">
                    <div id="crypto_widget" class="crypto-chart"></div>
                </div>
            </div>
        </div>
    </div>

    <style>
        :root {
            --vh: 12.05px;
            --primary-color: #2962ff;
            --secondary-color: #1c1f2a;
            --accent-color: #00ff88;
            --text-primary: #ffffff;
            --text-secondary: #5d6588;
        }

        html {
            font-size: 16px;
            -webkit-text-size-adjust: 100%;
        }

        body {
            background: #0a0b0e !important;
            min-height: 100vh;
            min-height: calc(var(--vh, 1vh) * 100);
            overflow-x: hidden;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
        }

        /* Responsive Font Sizes */
        @media screen and (min-width: 1920px) {
            html {
                font-size: 18px;
            }
        }

        @media screen and (max-width: 1366px) {
            html {
                font-size: 15px;
            }
        }

        @media screen and (max-width: 1024px) {
            html {
                font-size: 14px;
            }
        }

        @media screen and (max-width: 768px) {
            html {
                font-size: 13px;
            }
        }

        @media screen and (max-width: 480px) {
            html {
                font-size: 12px;
            }
        }

        .dashboard-wrapper {
            min-height: 100vh;
            min-height: calc(var(--vh, 1vh) * 100);
            background: #0a0b0e;
            padding-bottom: 0;
        }

        .card {
            border: none;
            border-radius: 12px;
            background: #13151c;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-header {
            background: #13151c;
            border-bottom: 1px solid #1c1f2a;
            padding: 1rem 1.5rem;
        }

        .card-title {
            color: var(--text-primary);
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .btn-dark {
            background: var(--secondary-color);
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            color: var(--text-primary);
        }
        
        .btn-dark:hover {
            background: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(41, 98, 255, 0.3);
        }
        
        .text-muted {
            color: var(--text-secondary) !important;
            font-size: 0.9rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .card h3 {
            color: var(--text-primary);
            font-weight: 700;
            font-size: 1.8rem;
            margin: 0;
        }
        
        .btn-outline-secondary {
            border-color: var(--secondary-color);
            color: var(--text-secondary);
            border-radius: 6px;
            padding: 6px 12px;
            transition: all 0.3s ease;
        }
        
        .btn-outline-secondary:hover {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .container-fluid {
            max-width: 1920px;
            margin: 0 auto;
            padding: 1.5rem;
        }

        .trading-chart {
            height: 600px;
            width: 100%;
            overflow: hidden;
            border-radius: 8px;
        }

        .crypto-chart {
            height: 400px;
            width: 100%;
            overflow: hidden;
            border-radius: 8px;
        }

        #tradingview_widget, #crypto_widget {
            background: #13151c;
        }

        .btn-group {
            gap: 0.5rem;
        }

        .btn-group .btn {
            flex: 1;
            border-radius: 8px !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-group .btn:hover {
            transform: translateY(-2px);
        }

        /* Stats Cards Animation */
        .col-md-3 {
            animation: fadeInUp 0.5s ease forwards;
        }

        .col-md-3:nth-child(1) { animation-delay: 0.1s; }
        .col-md-3:nth-child(2) { animation-delay: 0.2s; }
        .col-md-3:nth-child(3) { animation-delay: 0.3s; }
        .col-md-3:nth-child(4) { animation-delay: 0.4s; }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .container-fluid {
                padding: 1rem;
            }

            .row {
                margin-left: -0.5rem;
                margin-right: -0.5rem;
            }

            .col-md-3 {
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }

            .btn-group {
                flex-wrap: wrap;
                gap: 0.25rem;
            }

            .btn-group .btn {
                flex: 1 1 40%;
                margin: 2px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                padding: 10px 15px;
            }

            .trading-chart {
                height: 500px;
            }

            .crypto-chart {
                height: 350px;
            }

            .card-header {
                padding: 0.75rem 1rem;
            }

            .card-title {
                font-size: 1rem;
            }

            h3 {
                font-size: 1.5rem;
            }

            .card-body {
                padding: 1rem;
            }
        }

        /* Small phones */
        @media (max-width: 375px) {
            .btn-group .btn {
                flex: 1 1 100%;
                margin: 2px 0;
            }

            .trading-chart {
                height: 400px;
            }

            .crypto-chart {
                height: 300px;
            }

            .container-fluid {
                padding: 0.75rem;
            }
        }
    </style>

    <script>
        // Update viewport height variable
        function updateVH() {
            let vh = window.innerHeight * 0.01;
            document.documentElement.style.setProperty('--vh', `${vh}px`);
        }

        // Initial set
        updateVH();

        // Update on resize
        window.addEventListener('resize', updateVH);

        // Function to initialize TradingView with responsive settings
        function initTradingView() {
            new TradingView.widget({
                "width": "100%",
                "height": "100%",
                "symbol": "NASDAQ:AMZN",
                "interval": "1",
                "timezone": "exchange",
                "theme": "dark",
                "style": "1",
                "toolbar_bg": "#13151c",
                "enable_publishing": false,
                "allow_symbol_change": true,
                "container_id": "tradingview_widget",
                "hide_side_toolbar": window.innerWidth < 768,
                "hide_volume": window.innerWidth < 768,
                "backgroundColor": "#13151c",
                "gridColor": "#1c1f2a",
                "hide_drawing_toolbar": window.innerWidth < 768
            });
        }

        // Initialize Crypto Widget with responsive settings
        function initCryptoWidget() {
            new TradingView.MediumWidget({
                "container_id": "crypto_widget",
                "symbols": [
                    ["Bitcoin", "BINANCE:BTCUSDT|1D"],
                    ["Ethereum", "BINANCE:ETHUSDT|1D"],
                    ["Tether", "BINANCE:USDTUSDT|1D"],
                    ["XRP", "BINANCE:XRPUSDT|1D"],
                    ["BNB", "BINANCE:BNBUSDT|1D"],
                    ["Solana", "BINANCE:SOLUSDT|1D"]
                ],
                "chartOnly": window.innerWidth < 768,
                "width": "100%",
                "height": window.innerWidth < 768 ? "250" : "400",
                "locale": "en",
                "colorTheme": "dark",
                "gridLineColor": "#1c1f2a",
                "trendLineColor": "#1976d2",
                "fontColor": "#5d6588",
                "underLineColor": "#2962ff",
                "isTransparent": true,
                "autosize": true,
                "backgroundColor": "#13151c",
                "container_id": "crypto_widget",
                "scalePosition": window.innerWidth < 768 ? "right" : "left"
            });
        }

        // Initialize charts
        initTradingView();
        initCryptoWidget();

        // Reinitialize on orientation change
        window.addEventListener('orientationchange', function() {
            setTimeout(function() {
                document.getElementById('tradingview_widget').innerHTML = '';
                document.getElementById('crypto_widget').innerHTML = '';
                initTradingView();
                initCryptoWidget();
            }, 100);
        });

        // Existing Fullscreen toggle function
        function toggleFullscreen(button) {
            const card = button.closest('.card');
            if (!document.fullscreenElement) {
                card.requestFullscreen();
                button.innerHTML = '<i class="fas fa-compress"></i>';
            } else {
                document.exitFullscreen();
                button.innerHTML = '<i class="fas fa-expand"></i>';
            }
        }
    </script>

    <!-- Smartsupp Live Chat script -->
    <script type="text/javascript">
        var _smartsupp = _smartsupp || {};
        _smartsupp.key = '0c5f48735f0e2df778ee1ab793f855009f75ccce';
        window.smartsupp||(function(d) {
            var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
            s=d.getElementsByTagName('script')[0];c=d.createElement('script');
            c.type='text/javascript';c.charset='utf-8';c.async=true;
            c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
        })(document);
    </script>
    <noscript> Powered by <a href="https://www.smartsupp.com" target="_blank">Smartsupp</a></noscript>
</x-template.user>
