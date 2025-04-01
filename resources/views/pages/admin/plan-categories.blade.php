<x-template.admin title="Plan Categories" slug="plan-categories">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h3 class="mb-0">Investment Packages</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Package</th>
                                        <th>Deposit (US$)</th>
                                        <th>Profit (%)</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($plan_categories as $key => $category)
                                        <tr>
                                            <td>
                                                <strong class="font-18">{{ $category->title }}</strong>
                                                <div class="text-muted">{{ $category->description }}</div>
                                            </td>
                                            <td colspan="2" class="text-center">
                                                @foreach ($category->plans as $plan)
                                                    <div class="mb-2">
                                                        <strong>{{ $plan->title }}</strong>
                                                        @if ($plan->has_badge == 1)
                                                            <span class="badge badge-approved">Featured</span>
                                                        @endif
                                                        <div class="text-muted">
                                                            ${{ number_format($plan->minimum, 2) }} -
                                                            {{ $plan->maximum == 0 ? 'above' : '$' . number_format($plan->maximum, 2) }}
                                                        </div>
                                                        <div class="text-muted">{{ $plan->percentage }}%</div>
                                                    </div>
                                                @endforeach
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.plan-categories.delete', ['id' => $category->id]) }}"
                                                        onclick="return deleteRecord()" class="btn btn-sm btn-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                    @if ($key > 0)
                                                        <a href="{{ route('admin.plan-categories.move', ['id' => $category->id, 'dir' => 'up']) }}"
                                                            class="btn btn-sm btn-secondary">
                                                            <i class="bi bi-arrow-up"></i>
                                                        </a>
                                                    @endif
                                                    @if ($key < count($plan_categories)-1)
                                                        <a href="{{ route('admin.plan-categories.move', ['id' => $category->id, 'dir' => 'down']) }}"
                                                            class="btn btn-sm btn-secondary">
                                                            <i class="bi bi-arrow-down"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">New Package</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Package Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="alert alert-warning">
                    <h5 class="alert-heading">Investment Packages</h5>
                    <p class="mb-0">This is a logical grouping of Plans.</p>
                    <hr>
                    <p class="mb-0"><strong>Note:</strong> Deleting an investment package will delete all plans under it.</p>
                </div>
            </div>
        </div>
    </div>
</x-template.admin>
