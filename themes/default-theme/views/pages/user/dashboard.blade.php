<x-template.user title="Dashboard" slug="dashboard">
    <x-user.page-banner>Dashboard</x-user.page-banner>
    <div class="container">

        <h4>Welcome {{ Auth::user()->name }} </h4>

        <div class="row mb-5 mt-4">

            <div class="col-sm-6 col-md-3">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">Current Balance</div>
                    <div class="card-body">
                        <h5 class="card-title">$ {{ number_format($total_balance, 2) }}</h5>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Deposit Earnings</div>
                    <div class="card-body">
                        <h5 class="card-title">$ {{ number_format($total_earning, 2) }}</h5>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="card bg-info mb-3">
                    <div class="card-header">Withdrawal Requests</div>
                    <div class="card-body">
                        <h5 class="card-title">$ {{ number_format($pending_withdrawal, 2) }}</h5>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="card bg-warning mb-3">
                    <div class="card-header">Active Deposits</div>
                    <div class="card-body">
                        <h5 class="card-title">$ {{ number_format($active_deposit, 2) }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header">All Deposits</div>
                    <div class="card-body">
                        <h5 class="card-title">$ {{ number_format($total_deposit, 2) }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card bg-light mb-3">
                    <div class="card-header">Referral Commission</div>
                    <div class="card-body">
                        <h5 class="card-title">$ {{ number_format($referral_commission, 2) }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Bonuses</div>
                    <div class="card-body">
                        <h5 class="card-title">$ {{ number_format($total_bonus, 2) }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-header">Penalties</div>
                    <div class="card-body">
                        <h5 class="card-title">$ {{ number_format($total_penalty, 2) }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-template.user>
