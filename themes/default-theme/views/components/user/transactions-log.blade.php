<style>
    .penalty {
        background-color: #dc3545;
    }

    .bonus {
        background-color: #6c757d;
    }

    .deposit {
        background-color: #ffc107;
    }

    .withdrawal {
        background-color: #28a745;
    }

    .referral {
        background-color: #17a2b8;
    }

    .earning {
        background-color: #007bff;
    }
</style>

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Details</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($transactions))
                @foreach ($transactions as $trans)
                    <tr>
                        <td>
                            <strong>
                                {{ $trans->username }}
                            </strong>&nbsp;
                            <small>{{ $trans->log_type }}</small><br />
                            <small>{{ $trans->transaction_details }}</small>
                        </td>
                        <td>
                            ${{ $trans->amount }}<br />
                        </td>
                        <td>
                            <small> {{ $trans->created_at }}</small>
                        </td>
                    </tr>
                @endforeach
            @else:
                <tr>
                    <td colspan="3">No data found.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
