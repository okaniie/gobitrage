<x-template.admin title="Plans" slug="plans">
    <h3>Investment Packages</h3>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="list" width="100%" cellspacing="1" cellpadding="2" border="0">
        <tbody>
            <tr>
                <th><b>Package name</b></th>
                <th><b>Category</b></th>
                <th><b>Deposit (US$)</b></th>
                <th><b>Details</b></th>
                <th><b>Actions</b></th>
            </tr>
            @forelse ($plans as $key => $plan)
                <tr class="{{ $key % 2 == 0 ? 'row1' : 'row2' }}">
                    <td>
                        <strong class="font-18">{{ $plan->title }}</strong>
                        @if ($plan->has_badge == 1)
                            <small class="badge badge-approved">Featured</small>
                        @endif
                    </td>
                    <td>
                        {{ $plan->plan_category()->first()['title'] ?? 'N/A' }}
                    </td>
                    <td>
                        ${{ number_format($plan->minimum, 2) }} -
                        {{ $plan->maximum == 0 ? 'above' : '$' . number_format($plan->maximum, 2) }}
                    </td>
                    <td>
                        {{ $plan->percentage }}%
                        {{ $plan->profit_frequency === 'end' ? 'ROI at end of plan' : $plan->profit_frequency . ' ROI' }}
                        <br />
                        {{ $plan->duration }} {{ $plan->duration_type }} duration
                        <br />
                        {{ $plan->referral_percentage }}% referral commission
                    </td>
                    <td class="menutxt text-right">
                        <a href="{{ route('admin.plans.view', ['id' => $plan->id]) }}" 
                           class="btn btn-sm btn-primary">Edit</a>
                        <form method="POST" 
                              action="{{ route('admin.plans.delete', ['id' => $plan->id]) }}"
                              style="display: inline-block;"
                              onsubmit="return confirm('Are you sure you want to delete this investment package? This action cannot be undone.');">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No investment packages found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br />

    <div class="text-right">
        <a href="{{ route('admin.plans.view', ['id' => 'new']) }}" class="btn btn-success">
            Add a new Investment Package
        </a>
    </div>

    <br />

    <div class="alert alert-warning">
        <h4>Investment Packages</h4>
        <p>You can create unlimited sets of investment packages with any settings.</p>
        <p>Here you can view, edit and delete your packages and plans.</p>
        <ul>
            <li>Use the "Edit" button to modify an existing package</li>
            <li>Use the "Delete" button to remove a package (this action cannot be undone)</li>
            <li>Click "Add a new Investment Package" to create a new package</li>
        </ul>
    </div>

</x-template.admin>
