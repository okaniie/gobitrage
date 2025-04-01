<nav class="admin-nav">
    <div class="nav-section">
        <div class="menu-title">Main Menu</div>
        <a class="nav-link {{ $slug == 'dashboard' ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a class="nav-link {{ $slug == 'users' ? 'active' : '' }}" href="{{ route('admin.users') }}">
            <i class="bi bi-people"></i> Users
        </a>
        <a class="nav-link {{ $slug == 'plan-categories' ? 'active' : '' }}" href="{{ route('admin.plan-categories') }}">
            <i class="bi bi-box"></i> Investment Packages
        </a>
    </div>

    <div class="nav-section">
        <div class="menu-title">Financial</div>
        <a class="nav-link {{ $slug == 'withdrawals-request' ? 'active' : '' }}"
            href="{{ route('admin.withdrawals', ['status' => 'pending']) }}">
            <i class="bi bi-cash-stack"></i> Withdrawal Requests
        </a>
        <a class="nav-link {{ $slug == 'withdrawals' ? 'active' : '' }}" href="{{ route('admin.withdrawals') }}">
            <i class="bi bi-cash"></i> All Withdrawals
        </a>
        <a class="nav-link {{ $slug == 'pending-deposits' ? 'active' : '' }}"
            href="{{ route('admin.deposits', ['status' => 'pending']) }}">
            <i class="bi bi-wallet2"></i> Pending Deposits
        </a>
        <a class="nav-link {{ $slug == 'deposits' ? 'active' : '' }}" href="{{ route('admin.deposits') }}">
            <i class="bi bi-wallet"></i> All Deposits
        </a>
        <a class="nav-link {{ $slug == 'referrals' ? 'active' : '' }}" href="{{ route('admin.referrals') }}">
            <i class="bi bi-diagram-3"></i> Referrals
        </a>
    </div>

    <div class="nav-section">
        <div class="menu-title">Transactions</div>
        <a class="nav-link {{ $slug == 'transactions' && empty(request('log_type')) ? 'active' : '' }}" href="{{ route('admin.transactions') }}">
            <i class="bi bi-clock-history"></i> All Transactions
        </a>
        <a class="nav-link {{ request('log_type') == 'deposit' ? 'active' : '' }}" href="{{ route('admin.transactions', ['log_type' => 'deposit']) }}">
            <i class="bi bi-arrow-down-circle"></i> Deposits
        </a>
        <a class="nav-link {{ request('log_type') == 'deposit-earning' ? 'active' : '' }}" href="{{ route('admin.transactions', ['log_type' => 'deposit-earning']) }}">
            <i class="bi bi-graph-up"></i> Deposit Earnings
        </a>
        <a class="nav-link {{ request('log_type') == 'deposit-release' ? 'active' : '' }}" href="{{ route('admin.transactions', ['log_type' => 'deposit-release']) }}">
            <i class="bi bi-arrow-up-circle"></i> Deposit Releases
        </a>
        <a class="nav-link {{ request('log_type') == 'withdrawal' ? 'active' : '' }}" href="{{ route('admin.transactions', ['log_type' => 'withdrawal']) }}">
            <i class="bi bi-cash-coin"></i> Withdrawals
        </a>
        <a class="nav-link {{ request('log_type') == 'earning' ? 'active' : '' }}" href="{{ route('admin.transactions', ['log_type' => 'earning']) }}">
            <i class="bi bi-currency-dollar"></i> Earnings
        </a>
        <a class="nav-link {{ request('log_type') == 'referral' ? 'active' : '' }}" href="{{ route('admin.transactions', ['log_type' => 'referral']) }}">
            <i class="bi bi-share"></i> Referral Commissions
        </a>
        <a class="nav-link {{ request('log_type') == 'bonus' ? 'active' : '' }}" href="{{ route('admin.transactions', ['log_type' => 'bonus']) }}">
            <i class="bi bi-gift"></i> Bonuses
        </a>
        <a class="nav-link {{ request('log_type') == 'penalty' ? 'active' : '' }}" href="{{ route('admin.transactions', ['log_type' => 'penalty']) }}">
            <i class="bi bi-exclamation-triangle"></i> Penalties
        </a>
    </div>

    <div class="nav-section">
        <div class="menu-title">Communication</div>
        <a class="nav-link {{ $slug == 'newsletter' ? 'active' : '' }}" href="{{ route('admin.newsletter') }}">
            <i class="bi bi-envelope"></i> Send Newsletter
        </a>
    </div>

    <div class="nav-section">
        <div class="menu-title">Settings</div>
        <a class="nav-link {{ $slug == 'settings' ? 'active' : '' }}" href="{{ route('admin.settings') }}">
            <i class="bi bi-gear"></i> General Settings
        </a>
        <a class="nav-link {{ $slug == 'processings' ? 'active' : '' }}" href="{{ route('admin.processings') }}">
            <i class="bi bi-cpu"></i> Processings
        </a>
        <a class="nav-link {{ $slug == 'auto-withdrawal' ? 'active' : '' }}" href="{{ route('admin.settings.autowithdrawal') }}">
            <i class="bi bi-robot"></i> Auto-withdrawal Settings
        </a>
        <a class="nav-link {{ $slug == 'email-templates' ? 'active' : '' }}" href="{{ route('admin.email-templates') }}">
            <i class="bi bi-envelope-check"></i> Email Templates
        </a>
    </div>

    <div class="nav-section mt-auto">
        <a class="nav-link text-danger" href="#" onclick="event.preventDefault(); handleLogout()">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>

    <script>
    function handleLogout() {
        if (confirm('Are you sure you want to logout?')) {
            fetch('{{ route('logout') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            }).then(response => {
                if (response.ok) {
                    window.location.href = '/';
                }
            });
        }
    }
    </script>
</nav>

<style>
.admin-nav {
    display: flex;
    flex-direction: column;
    height: 100%;
    padding: 1rem;
}

.nav-section {
    margin-bottom: 1.5rem;
}

.menu-title {
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: uppercase;
    color: #6c757d;
    margin-bottom: 0.5rem;
    padding-left: 0.5rem;
}

.nav-link {
    display: flex;
    align-items: center;
    padding: 0.75rem 0.5rem;
    color: #333;
    text-decoration: none;
    border-radius: 0.375rem;
    transition: all 0.2s ease;
    margin-bottom: 0.25rem;
}

.nav-link i {
    margin-right: 0.75rem;
    font-size: 1.1rem;
}

.nav-link:hover {
    background-color: rgba(0, 0, 0, 0.05);
    color: #000;
}

.nav-link.active {
    background-color: var(--primary-color);
    color: #fff;
}

@media (prefers-color-scheme: dark) {
    .menu-title {
        color: #adb5bd;
    }

    .nav-link {
        color: #fff;
    }

    .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff;
    }

    .nav-link.active {
        background-color: var(--primary-color);
        color: #fff;
    }
}

@media (max-width: 768px) {
    .admin-nav {
        padding: 0.5rem;
    }

    .nav-link {
        padding: 1rem 0.5rem;
    }
}
</style>