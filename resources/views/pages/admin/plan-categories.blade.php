<x-template.admin title="Plan Categories" slug="plan-categories">
    <h3>Investment Packages</h3>

    <table class="list" width="100%" cellspacing="1" cellpadding="2" border="0">
        <tbody>
            <tr>
                <th><b>Package</b></th>
                <th><b>Deposit (US$)</b></th>
                <th><b>Profit (%)</b></th>
                <th><b>-</b></th>
            </tr>
            @foreach ($plan_categories as $key => $category)
                <tr class="row1">
                    <td><strong class="font-18">{{ $category->title }}</strong></td>
                    <td colspan="2" style="text-align: center">{{ $category->description }}</td>
                    <td class="menutxt" bgcolor="FFF9B3" align="right">
                        <a href="{{ route('admin.plan-categories.delete', ['id' => $category->id]) }}"
                            onclick="return deleteRecord()">[delete]</a>
                        @if ($key > 0)
                            <a
                                href="{{ route('admin.plan-categories.move', ['id' => $category->id, 'dir' => 'up']) }}">[up]</a>
                        @endif
                        @if ($key < count($plan_categories)-1)
                            <a
                                href="{{ route('admin.plan-categories.move', ['id' => $category->id, 'dir' => 'down']) }}">[down]</a>
                        @endif
                    </td>
                </tr>
                @foreach ($category->plans as $key => $plan)
                    <tr class="row2">
                        <td>
                            {{ $plan->title }}<br />
                            @if ($plan->has_badge == 1)
                                <small class="badge badge-approved">Featured</small>
                            @endif
                        </td>
                        <td style="text-align: right">
                            ${{ number_format($plan->minimum, 2) }} -
                            {{ $plan->maximum == 0 ? 'above' : '$' . number_format($plan->maximum, 2) }}
                        </td>
                        <td style="text-align: right">
                            {{ $plan->percentage }}%
                        </td>
                        <td class="menutxt" bgcolor="FFF9B3" align="right">
                            <a href="{{ route('admin.plans.view', ['id' => $plan->id]) }}">[edit]</a>
                            <a href="{{ route('admin.plans.delete', ['id' => $plan->id]) }}"
                                onclick="return deleteRecord()">[delete]</a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" style="text-align: right">
                        <form method="get" action="{{ route('admin.plans.view', ['id' => 'new']) }}">
                            <input type="hidden" name="plan_category_id" value="{{ $category->id }}" />
                            <input type="submit" value="+ Add Plan" class="sbmt" size="15"  style="background-color:#0005"/>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <hr />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
        <tbody>
            <tr>
                <td width="100%" valign="top" height="100%">
                    <h3>New Package</h3>
                    <form method="post" action="">
                        @csrf
                        <table class="form settings">
                            <tbody>
                                <tr>
                                    <th colspan="2"></th>
                                </tr>
                                <tr>
                                    <th>Package Title:</th>
                                    <td><input type="text" name="title" value="{{ old('title') }}" class="inpts"
                                            style="width:98%"></td>
                                </tr>

                                <tr>
                                    <th>Description:</th>
                                    <td>
                                        <textarea name="description" class="inpts" style="width:98%">{{ old('description') }}</textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <center> <input type="submit" value="Submit" class="btn btn-success sbmt"> </center>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>

    <br />

    <div class="alert alert-warning"> Investment Packages:<br>
        This is a logical grouping of Plans.<br><br>
        <strong>Note:</strong> Deleting an investment package will delete all plans under it.
    </div>

</x-template.admin>
