<!-- Crypto Price Ticker -->
<div class="crypto-ticker-wrapper">
    <div class="crypto-ticker">
        <div class="ticker-content">
            <!-- First set of items -->
            <div class="ticker-item">
                <span class="crypto-symbol">BTC</span>
                <span class="crypto-price" id="btc-price">Loading...</span>
            </div>
            <div class="ticker-item">
                <span class="crypto-symbol">ETH</span>
                <span class="crypto-price" id="eth-price">Loading...</span>
            </div>
            <div class="ticker-item">
                <span class="crypto-symbol">USDT</span>
                <span class="crypto-price" id="usdt-price">Loading...</span>
            </div>
            <div class="ticker-item">
                <span class="crypto-symbol">BNB</span>
                <span class="crypto-price" id="bnb-price">Loading...</span>
            </div>
            <div class="ticker-item">
                <span class="crypto-symbol">XRP</span>
                <span class="crypto-price" id="xrp-price">Loading...</span>
            </div>
            <div class="ticker-item">
                <span class="crypto-symbol">ADA</span>
                <span class="crypto-price" id="ada-price">Loading...</span>
            </div>
            <!-- Duplicate set for continuous scrolling -->
            <div class="ticker-item">
                <span class="crypto-symbol">BTC</span>
                <span class="crypto-price" id="btc-price-2">Loading...</span>
            </div>
            <div class="ticker-item">
                <span class="crypto-symbol">ETH</span>
                <span class="crypto-price" id="eth-price-2">Loading...</span>
            </div>
            <div class="ticker-item">
                <span class="crypto-symbol">USDT</span>
                <span class="crypto-price" id="usdt-price-2">Loading...</span>
            </div>
            <div class="ticker-item">
                <span class="crypto-symbol">BNB</span>
                <span class="crypto-price" id="bnb-price-2">Loading...</span>
            </div>
            <div class="ticker-item">
                <span class="crypto-symbol">XRP</span>
                <span class="crypto-price" id="xrp-price-2">Loading...</span>
            </div>
            <div class="ticker-item">
                <span class="crypto-symbol">ADA</span>
                <span class="crypto-price" id="ada-price-2">Loading...</span>
            </div>
        </div>
    </div>
</div>

<style>
.crypto-ticker-wrapper {
    background: var(--primary-color);
    padding: 8px 0;
    overflow: hidden;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.crypto-ticker {
    width: 100%;
    overflow: hidden;
}

.ticker-content {
    display: flex;
    animation: ticker 30s linear infinite;
    width: fit-content;
}

.ticker-item {
    display: flex;
    align-items: center;
    padding: 0 20px;
    white-space: nowrap;
    color: var(--text-color);
}

.crypto-symbol {
    font-weight: bold;
    margin-right: 8px;
    color: var(--secondary-color);
}

.crypto-price {
    font-family: 'Nunito', monospace;
}

@keyframes ticker {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-50%);
    }
}

/* Pause animation on hover */
.crypto-ticker-wrapper:hover .ticker-content {
    animation-play-state: paused;
}
</style>

<script>
async function updateCryptoPrices() {
    try {
        const response = await fetch('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethereum,tether,binancecoin,ripple,cardano&vs_currencies=usd&include_24hr_change=true');
        const data = await response.json();
        
        // Update first set of prices
        document.getElementById('btc-price').textContent = `$${data.bitcoin.usd.toLocaleString()}`;
        document.getElementById('eth-price').textContent = `$${data.ethereum.usd.toLocaleString()}`;
        document.getElementById('usdt-price').textContent = `$${data.tether.usd.toLocaleString()}`;
        document.getElementById('bnb-price').textContent = `$${data.binancecoin.usd.toLocaleString()}`;
        document.getElementById('xrp-price').textContent = `$${data.ripple.usd.toLocaleString()}`;
        document.getElementById('ada-price').textContent = `$${data.cardano.usd.toLocaleString()}`;
        
        // Update second set of prices
        document.getElementById('btc-price-2').textContent = `$${data.bitcoin.usd.toLocaleString()}`;
        document.getElementById('eth-price-2').textContent = `$${data.ethereum.usd.toLocaleString()}`;
        document.getElementById('usdt-price-2').textContent = `$${data.tether.usd.toLocaleString()}`;
        document.getElementById('bnb-price-2').textContent = `$${data.binancecoin.usd.toLocaleString()}`;
        document.getElementById('xrp-price-2').textContent = `$${data.ripple.usd.toLocaleString()}`;
        document.getElementById('ada-price-2').textContent = `$${data.cardano.usd.toLocaleString()}`;
    } catch (error) {
        console.error('Error fetching crypto prices:', error);
    }
}

// Update prices every 30 seconds
updateCryptoPrices();
setInterval(updateCryptoPrices, 30000);
</script> 