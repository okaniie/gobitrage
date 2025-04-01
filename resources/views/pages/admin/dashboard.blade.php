<x-template.admin title="Dashboard" slug="dashboard">
    <div class="dashboard-container">
        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="stat-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="stat-content">
                            <h6 class="stat-label">Total Users</h6>
                            <h3 class="stat-value">{{ $users['total'] }}</h3>
                            <div class="stat-badges">
                                <span class="badge bg-success">{{ $users['active'] }} Active</span>
                                <span class="badge bg-danger">{{ $users['blocked'] }} Blocked</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="stat-icon">
                            <i class="bi bi-box"></i>
                        </div>
                        <div class="stat-content">
                            <h6 class="stat-label">Investment Packages</h6>
                            <h3 class="stat-value">{{ $plans }}</h3>
                            <p class="stat-text">Active packages</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="stat-icon">
                            <i class="bi bi-diagram-3"></i>
                        </div>
                        <div class="stat-content">
                            <h6 class="stat-label">Total Referrals</h6>
                            <h3 class="stat-value">{{ $referrals['total'] }}</h3>
                            <p class="stat-text">Bonus: {{ number_format($referrals['amount'], 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="stat-icon">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                        <div class="stat-content">
                            <h6 class="stat-label">Pending Withdrawals</h6>
                            <h3 class="stat-value">
                                @php
                                    $pending = collect($withdrawals)->where('status', 'pending')->sum('total');
                                @endphp
                                {{ $pending }}
                            </h3>
                            <p class="stat-text">Awaiting approval</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row g-4 mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="quick-actions">
                            <a href="{{ route('admin.withdrawals', ['status' => 'pending']) }}" class="action-btn">
                                <i class="bi bi-cash-stack"></i>
                                <span>Process Withdrawals</span>
                            </a>
                            <a href="{{ route('admin.deposits', ['status' => 'pending']) }}" class="action-btn">
                                <i class="bi bi-wallet2"></i>
                                <span>Review Deposits</span>
                            </a>
                            <a href="{{ route('admin.users') }}" class="action-btn">
                                <i class="bi bi-people"></i>
                                <span>Manage Users</span>
                            </a>
                            <a href="{{ route('admin.settings') }}" class="action-btn">
                                <i class="bi bi-gear"></i>
                                <span>System Settings</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Recent Deposits</h5>
                        <a href="{{ route('admin.deposits') }}" class="btn btn-sm btn-link">View All</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($deposits->take(5) as $deposit)
                                    <tr>
                                        <td>{{ $deposit->user->username }}</td>
                                        <td>{{ number_format($deposit->amount, 2) }} {{ $deposit->currency }}</td>
                                        <td>
                                            <span class="badge bg-{{ $deposit->status === 'approved' ? 'success' : 'warning' }}">
                                                {{ ucfirst($deposit->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $deposit->created_at->format('M d, Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Recent Withdrawals</h5>
                        <a href="{{ route('admin.withdrawals') }}" class="btn btn-sm btn-link">View All</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($withdrawals->take(5) as $withdrawal)
                                    <tr>
                                        <td>{{ $withdrawal->user->username }}</td>
                                        <td>{{ number_format($withdrawal->amount, 2) }} {{ $withdrawal->currency }}</td>
                                        <td>
                                            <span class="badge bg-{{ $withdrawal->status === 'approved' ? 'success' : 'warning' }}">
                                                {{ ucfirst($withdrawal->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $withdrawal->created_at->format('M d, Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Help Section -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="help-icon">
                                <i class="bi bi-info-circle"></i>
                            </div>
                            <div class="help-content">
                                <h5 class="help-title">Welcome to the Admin Dashboard!</h5>
                                <p class="help-text mb-0">Here you can manage your system's users, transactions, and settings. Use the navigation menu on the left to access different sections.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    .dashboard-container {
        padding: 1rem;
    }

    .card {
        border: none;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        background-color: var(--card-background);
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .card-header {
        background: none;
        border-bottom: 1px solid var(--border-color);
        padding: 1rem;
    }

    .card-title {
        color: var(--text-color);
        font-weight: 600;
    }

    .stat-card {
        height: 100%;
    }

    .stat-card .card-body {
        display: flex;
        align-items: center;
        padding: 1.5rem;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background-color: rgba(var(--primary-color-rgb), 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
    }

    .stat-icon i {
        font-size: 1.5rem;
        color: var(--primary-color);
    }

    .stat-content {
        flex: 1;
    }

    .stat-label {
        color: var(--secondary-color);
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
    }

    .stat-value {
        color: var(--text-color);
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .stat-text {
        color: var(--secondary-color);
        font-size: 0.875rem;
        margin-bottom: 0;
    }

    .stat-badges {
        display: flex;
        gap: 0.5rem;
    }

    .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .action-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 1.5rem;
        background-color: rgba(var(--primary-color-rgb), 0.05);
        border-radius: 12px;
        color: var(--text-color);
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .action-btn:hover {
        background-color: rgba(var(--primary-color-rgb), 0.1);
        color: var(--primary-color);
        transform: translateY(-2px);
    }

    .action-btn i {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }

    .table {
        margin-bottom: 0;
    }

    .table th {
        border-top: none;
        font-weight: 600;
        color: var(--secondary-color);
        font-size: 0.875rem;
    }

    .table td {
        vertical-align: middle;
        color: var(--text-color);
    }

    .badge {
        padding: 0.5em 0.75em;
        font-weight: 500;
    }

    .help-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background-color: rgba(var(--info-color-rgb), 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
    }

    .help-icon i {
        font-size: 1.5rem;
        color: var(--info-color);
    }

    .help-title {
        color: var(--text-color);
        font-size: 1.125rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .help-text {
        color: var(--secondary-color);
    }

    @media (max-width: 768px) {
        .dashboard-container {
            padding: 0.5rem;
        }

        .card {
            margin-bottom: 1rem;
        }

        .quick-actions {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        }

        .action-btn {
            padding: 1rem;
        }

        .table-responsive {
            margin: 0 -1rem;
        }
    }
    </style>
</x-template.admin>
