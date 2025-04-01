<style>
    .bi {
        vertical-align: -.125em;
        pointer-events: none;
        fill: currentColor;
    }

    .dropdown-toggle {
        outline: 0;
    }

    .nav-flush .nav-link {
        border-radius: 0;
    }
</style>
<div class="d-flex flex-column flex-shrink-0 bg-light" style="border-right: 2px solid #0d6efd">
    <a href="{{ route('user.dashboard') }}" class="d-block p-3 link-dark text-decoration-none" title="Icon-only"
        data-bs-toggle="tooltip" data-bs-placement="right">
        <svg class="bi" width="40" height="32">
            <use xlink:href="#bootstrap" />
        </svg>
        <span class="visually-hidden">Icon-only</span>
        
    </a>
    <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
        <li>
            <a href="{{ route('user.dashboard') }}"
             class="flex gap-3 px-3 py-2 {{ $slug == 'dashboard' ? 'nav-btn' : '' }}"
                title="Dashboard" data-bs-toggle="tooltip" data-bs-placement="right">
                <svg class="bi" width="24" height="24" role="img" aria-label="Dashboard">
                    <use xlink:href="#speedometer" />
                </svg>
                <p>Account</p>
             </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('user.deposits') }}"
                class="flex gap-3 {{ $slug == 'deposits' ? 'nav-btn' : '' }} py-3 border-bottom" aria-current="page"
                title="Deposits" data-bs-toggle="tooltip" data-bs-placement="right">
                <svg class="bi" width="24" height="24" role="img" aria-label="Deposits">
                    <use xlink:href="#bank-fill" />
                </svg>
            </a>
        </li>
        <li>
            <a href="{{ route('user.withdrawals') }}"
                class="flex gap-3 {{ $slug == 'withdrawals' ? 'nav-btn' : '' }} py-3 border-bottom" title="Withdrawals"
                data-bs-toggle="tooltip" data-bs-placement="right">
                <svg role="img" aria-label="Withdrawals" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path
                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm1 16.947v1.053h-1v-.998c-1.035-.018-2.106-.265-3-.727l.455-1.644c.956.371 2.229.765 3.225.54 1.149-.26 1.384-1.442.114-2.011-.931-.434-3.778-.805-3.778-3.243 0-1.363 1.039-2.583 2.984-2.85v-1.067h1v1.018c.724.019 1.536.145 2.442.42l-.362 1.647c-.768-.27-1.617-.515-2.443-.465-1.489.087-1.62 1.376-.581 1.916 1.712.805 3.944 1.402 3.944 3.547.002 1.718-1.343 2.632-3 2.864z" />
                </svg>
            </a>
        </li>
        <li>
            <a href="{{ route('user.referrals') }}"
                class="flex gap-3 {{ $slug == 'referrals' ? 'nav-btn' : '' }} py-3 border-bottom" title="Referrals"
                data-bs-toggle="tooltip" data-bs-placement="right">
                <svg class="bi" width="24" height="24" role="img" aria-label="Referrals">
                    <use xlink:href="#people-fill" />
                </svg>
            </a>
        </li>
        <li>
            <a href="{{ route('user.transactions') }}"
                class="flex gap-3 {{ $slug == 'transactions' ? 'nav-btn' : '' }} py-3 border-bottom" title="Transactions"
                data-bs-toggle="tooltip" data-bs-placement="right">
                <svg class="bi" width="24" height="24" role="img" aria-label="Profile">
                    <use xlink:href="#list-fill" />
                </svg>
            </a>
        </li>
        <li>
            <a href="{{ route('user.profile') }}"
                class="flex gap-3 {{ $slug == 'profile' ? 'nav-btn' : '' }} py-3 border-bottom" title="Profile"
                data-bs-toggle="tooltip" data-bs-placement="right">
                <svg class="bi" width="24" height="24" role="img" aria-label="Profile">
                    <use xlink:href="#people-circle" />
                </svg>
            </a>
        </li>
        <li>
            <a href="#"
                onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"
                class="flex gap-3 py-3 border-bottom" title="Logout" data-bs-toggle="tooltip" data-bs-placement="right">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path d="M16 10v-5l8 7-8 7v-5h-8v-4h8zm-16-8v20h14v-2h-12v-16h12v-2h-14z" />
                </svg>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</div>
