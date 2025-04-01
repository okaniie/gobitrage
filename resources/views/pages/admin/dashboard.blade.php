<x-template.admin title="Dashboard" slug="dashboard">
    <div class="dashboard-container">
        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Total Users</h6>
                        <h3 class="card-title mb-0">{{ $users['total'] }}</h3>
                        <div class="mt-2">
                            <span class="badge bg-success">{{ $users['active'] }} Active</span>
                            <span class="badge bg-danger">{{ $users['blocked'] }} Blocked</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Investment Packages</h6>
                        <h3 class="card-title mb-0">{{ $plans }}</h3>
                        <p class="card-text text-muted mb-0">Active packages</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Total Referrals</h6>
                        <h3 class="card-title mb-0">{{ $referrals['total'] }}</h3>
                        <p class="card-text text-muted mb-0">Bonus: {{ number_format($referrals['amount'], 2) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Pending Withdrawals</h6>
                        <h3 class="card-title mb-0">
                            @php
                                $pending = collect($withdrawals)->where('status', 'pending')->sum('total');
                            @endphp
                            {{ $pending }}
                        </h3>
                        <p class="card-text text-muted mb-0">Awaiting approval</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row g-4 mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('admin.withdrawals', ['status' => 'pending']) }}" class="btn btn-primary">
                                <i class="bi bi-cash-stack"></i> Process Withdrawals
                            </a>
                            <a href="{{ route('admin.deposits', ['status' => 'pending']) }}" class="btn btn-success">
                                <i class="bi bi-wallet2"></i> Review Deposits
                            </a>
                            <a href="{{ route('admin.users') }}" class="btn btn-info">
                                <i class="bi bi-people"></i> Manage Users
                            </a>
                            <a href="{{ route('admin.settings') }}" class="btn btn-secondary">
                                <i class="bi bi-gear"></i> System Settings
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
                <div class="alert alert-info">
                    <h5 class="alert-heading">Welcome to the Admin Dashboard!</h5>
                    <p class="mb-0">Here you can manage your system's users, transactions, and settings. Use the navigation menu on the left to access different sections.</p>
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
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: transform 0.2s ease;
    }

    .card:hover {
        transform: translateY(-2px);
    }

    .card-header {
        background: none;
        border-bottom: 1px solid rgba(0,0,0,0.1);
    }

    .table {
        margin-bottom: 0;
    }

    .table th {
        border-top: none;
        font-weight: 600;
    }

    .badge {
        padding: 0.5em 0.75em;
    }

    @media (prefers-color-scheme: dark) {
        .card {
            background: #2d2d2d;
            border-color: #404040;
        }

        .card-header {
            border-color: #404040;
        }

        .table {
            color: #fff;
        }

        .table th,
        .table td {
            border-color: #404040;
        }

        .text-muted {
            color: #adb5bd !important;
        }

        .alert-info {
            background-color: #1a1a1a;
            border-color: #404040;
            color: #fff;
        }
    }

    @media (max-width: 768px) {
        .dashboard-container {
            padding: 0.5rem;
        }

        .card {
            margin-bottom: 1rem;
        }

        .table-responsive {
            margin: 0 -1rem;
        }
    }
    </style>
</x-template.admin>
