<nav>
    <div class="menu-title">Menu</div>
    <a class="first {{ $slug == 'dashboard' ? 'active' : null }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a class="{{ $slug == 'users' ? 'active' : null }}" href="{{ route('admin.users') }}">Users</a>
    <a class="{{ $slug == 'plan-categories' ? 'active' : null }}" href="{{ route('admin.plan-categories') }}">Investment Packages</a>

    <span class="nav-divider"></span>

    <a class="first {{ $slug == 'withdrawals-request' ? 'active' : null }}"
        href="{{ route('admin.withdrawals', ['status' => 'pending']) }}">Withdrawal
        Requests</a>
    <a class="{{ $slug == 'withdrawals' ? 'active' : null }}" href="{{ route('admin.withdrawals') }}">All
        Withdrawals</a>
    <a class="{{ $slug == 'pending-deposits' ? 'active' : null }}"
        href="{{ route('admin.deposits', ['status' => 'pending']) }}">Pending Deposits</a>
    <a class="{{ $slug == 'deposits' ? 'active' : null }}" href="{{ route('admin.deposits') }}">All Deposits</a>
    <a class="{{ $slug == 'referrals' ? 'active' : null }}" href="{{ route('admin.referrals') }}">Referrals</a>

    <span class="nav-divider"></span>

    <a class="first {{ $slug == 'transactions' ? 'active' : null }}" href="{{ route('admin.transactions') }}">Transactions</a>
    <a href="{{ route('admin.transactions', ['log_type' => 'deposit']) }}">Deposits</a>
    <a href="{{ route('admin.transactions', ['log_type' => 'deposit-earning']) }}">Deposit
        Earnings</a>
    <a href="{{ route('admin.transactions', ['log_type' => 'deposit-release']) }}">Deposit
        Releases</a>
    <a href="{{ route('admin.transactions', ['log_type' => 'withdrawal']) }}">Withdrawals</a>
    <a href="{{ route('admin.transactions', ['log_type' => 'earning']) }}">Earnings</a>
    <a href="{{ route('admin.transactions', ['log_type' => 'referral']) }}">Referral
        Commissions</a>
    <a href="{{ route('admin.transactions', ['log_type' => 'bonus']) }}">Bonuses</a>
    <a href="{{ route('admin.transactions', ['log_type' => 'penalty']) }}">Penalties</a>

    <span class="nav-divider"></span>

    <a class="first {{ $slug == 'newsletter' ? 'active' : null }}" href="{{ route('admin.newsletter') }}">Send Newsletter</a>

    <span class="nav-divider"></span>

    <a class="first {{ $slug == 'settings' ? 'active' : null }}" href="{{ route('admin.settings') }}">Settings</a>
    <a class="{{ $slug == 'processings' ? 'active' : null }}" href="{{ route('admin.processings') }}">Processings</a>
    <a class="{{ $slug == 'auto-withdrawal' ? 'active' : null }}" href="{{ route('admin.settings.autowithdrawal') }}">Autowithdrawal Settings</a>
    <a class="{{ $slug == 'email-templates' ? 'active' : null }}" href="{{ route('admin.email-templates') }}">Email Templates</a>

    <span class="nav-divider"></span>

    <a class="first" href="#" onclick="event.preventDefault(); handleLogout()">
        <span>Logout</span>
    </a>

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
