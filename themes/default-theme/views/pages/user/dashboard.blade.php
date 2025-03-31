<x-template.user title="Dashboard" slug="dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=0.7, shrink-to-fit=no">
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
        }

        body {
            background: #0a0b0e !important;
            min-height: 100vh;
            min-height: calc(var(--vh, 1vh) * 100);
            overflow-x: hidden;
        }

        .dashboard-wrapper {
            min-height: 100vh;
            min-height: calc(var(--vh, 1vh) * 100);
            background: #0a0b0e;
            padding-bottom: 2rem;
        }

        .card {
            border: none;
            border-radius: 8px;
            background: #13151c;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .btn-dark {
            background: #1c1f2a;
            border: none;
            padding: 10px 20px;
        }
        
        .btn-dark:hover {
            background: #252936;
        }
        
        .text-muted {
            color: #5d6588 !important;
        }
        
        .card-header {
            background: #13151c;
            border-bottom: 1px solid #1c1f2a;
        }
        
        .btn-outline-secondary {
            border-color: #1c1f2a;
            color: #5d6588;
        }
        
        .btn-outline-secondary:hover {
            background: #1c1f2a;
            color: white;
        }

        .container-fluid {
            max-width: 1920px;
            margin: 0 auto;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .trading-chart {
            height: 400px;
            width: 100%;
            overflow: hidden;
        }

        .crypto-chart {
            height: 400px;
            width: 100%;
            overflow: hidden;
        }

        #tradingview_widget, #crypto_widget {
            background: #13151c;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .container-fluid {
                padding-left: 0.5rem;
                padding-right: 0.5rem;
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
            }

            .btn-group .btn {
                flex: 1 1 40%;
                margin: 2px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .trading-chart, .crypto-chart {
                height: 300px;
            }

            .card-header {
                padding: 0.75rem;
            }

            .card-title {
                font-size: 1rem;
            }

            h3 {
                font-size: 1.25rem;
            }

            h5 {
                font-size: 0.875rem;
            }
        }

        /* Small phones */
        @media (max-width: 375px) {
            .btn-group .btn {
                flex: 1 1 100%;
            }

            .trading-chart, .crypto-chart {
                height: 250px;
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
</x-template.user>
