<x-template.guest>
    <style>
        .auth-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .auth-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 1rem;
        }

        .auth-header p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.1rem;
        }

        .form-section {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .section-title {
            font-size: 1.2rem;
            color: #fff;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-title i {
            font-size: 1.4rem;
            color: var(--primary-color);
        }

        .form-floating {
            margin-bottom: 1rem;
        }

        .form-floating > .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            height: 60px;
            padding: 1rem 0.75rem;
        }

        .form-floating > label {
            padding: 1rem 0.75rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .form-floating > .form-control:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(var(--primary-rgb), 0.25);
        }

        .form-floating > .form-control:focus ~ label {
            color: var(--primary-color);
        }

        .wallet-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .submit-btn {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            width: 100%;
            margin-top: 1rem;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(var(--primary-rgb), 0.3);
        }

        .auth-footer {
            text-align: center;
            margin-top: 2rem;
        }

        .auth-footer a {
            color: var(--primary-color);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .auth-footer a:hover {
            color: var(--secondary-color);
        }

        @media (max-width: 768px) {
            .auth-container {
                margin: 1rem;
                padding: 1.5rem;
            }

            .wallet-grid {
                grid-template-columns: 1fr;
            }

            .auth-header h1 {
                font-size: 2rem;
            }
        }
    </style>

    <div class="auth-container">
        <div class="auth-header">
            <h1>Create Your Account</h1>
            <p>Join our platform and start investing in cryptocurrencies</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <!-- Personal Information Section -->
            <div class="form-section">
                <div class="section-title">
                    <i class="bi bi-person-circle"></i>
                    Personal Information
                </div>
                
                <div class="form-floating">
                    <input type="text" class="form-control @error('username') is-invalid @enderror" 
                        name="username" value="{{ old('username') }}" id="username" 
                        placeholder="Username">
                    <label for="username">Username (optional)</label>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                        name="name" value="{{ old('name') }}" required id="name" 
                        placeholder="Full Name">
                    <label for="name">Full Name</label>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                        name="email" value="{{ old('email') }}" required id="email" 
                        placeholder="name@example.com">
                    <label for="email">Email Address</label>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                        name="password" required id="password" placeholder="Password">
                    <label for="password">Password</label>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Wallet Addresses Section -->
            <div class="form-section">
                <div class="section-title">
                    <i class="bi bi-wallet2"></i>
                    Wallet Addresses
                </div>

                <div class="wallet-grid">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="btc_address" 
                            value="{{ old('btc_address') }}" id="btc_address" 
                            placeholder="Bitcoin Address">
                        <label for="btc_address">Bitcoin (BTC)</label>
                    </div>

                    <div class="form-floating">
                        <input type="text" class="form-control" name="eth_address" 
                            value="{{ old('eth_address') }}" id="eth_address" 
                            placeholder="Ethereum Address">
                        <label for="eth_address">Ethereum (ETH)</label>
                    </div>

                    <div class="form-floating">
                        <input type="text" class="form-control" name="usdt_erc_address" 
                            value="{{ old('usdt_erc_address') }}" id="usdt_erc_address" 
                            placeholder="USDT ERC20 Address">
                        <label for="usdt_erc_address">USDT (ERC20)</label>
                    </div>

                    <div class="form-floating">
                        <input type="text" class="form-control" name="usdt_trc_address" 
                            value="{{ old('usdt_trc_address') }}" id="usdt_trc_address" 
                            placeholder="USDT TRC20 Address">
                        <label for="usdt_trc_address">USDT (TRC20)</label>
                    </div>

                    <div class="form-floating">
                        <input type="text" class="form-control" name="trx_address" 
                            value="{{ old('trx_address') }}" id="trx_address" 
                            placeholder="TRON Address">
                        <label for="trx_address">TRON (TRX)</label>
                    </div>

                    <div class="form-floating">
                        <input type="text" class="form-control" name="bnb_address" 
                            value="{{ old('bnb_address') }}" id="bnb_address" 
                            placeholder="BNB Smart Chain Address">
                        <label for="bnb_address">BNB Smart Chain</label>
                    </div>

                    <div class="form-floating">
                        <input type="text" class="form-control" name="ltc_address" 
                            value="{{ old('ltc_address') }}" id="ltc_address" 
                            placeholder="Litecoin Address">
                        <label for="ltc_address">Litecoin (LTC)</label>
                    </div>

                    <div class="form-floating">
                        <input type="text" class="form-control" name="doge_address" 
                            value="{{ old('doge_address') }}" id="doge_address" 
                            placeholder="Dogecoin Address">
                        <label for="doge_address">Dogecoin (DOGE)</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary submit-btn">
                Create Account
            </button>
        </form>

        <div class="auth-footer">
            @if (Route::has('login'))
                <p>Already have an account? 
                    <a href="{{ route('login') }}">Login here</a>
                </p>
            @endif
        </div>
    </div>
</x-template.guest>
