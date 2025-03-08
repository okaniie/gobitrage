<x-template.admin :title="'Plan #' . $plan->id" slug="plans">
    <table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
        <tbody>
            <tr>
                <td width="100%" valign="top" height="100%">
                    <h3>Package: {{ $plan_category_title }}<br/>
                        Plan: {{ $plan->title }}</h3>
                    <form method="post" action="">
                        @csrf
                        <table class="form settings">
                            <tbody>
                                <tr>
                                    <th colspan="2"></th>
                                </tr>
                                <tr>
                                    <th>Title:</th>
                                    <td><input type="text" name="title" value="{{ $plan->title }}" class="inpts"
                                            style="width:98%"></td>
                                </tr>

                                <tr>
                                    <th>Plan Category:</th>
                                    <td> <select name="plan_category_id" class="inpts">
                                            @foreach ($plan_categories as $category)
                                                <option {{ $plan->plan_category_id == $category->id ? 'selected' : '' }}
                                                    value="{{ $category->id }}">{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Featured Plan:</th>
                                    <td> <select name="has_badge" class="inpts">
                                            <option {{ $plan->has_badge == 0 ? 'selected' : '' }} value="0">
                                                No
                                            </option>
                                            <option {{ $plan->has_badge == 1 ? 'selected' : '' }} value="1">
                                                Yes
                                            </option>
                                        </select>
                                        <div class="alert alert-warning">If set to YES, the plan will receive a FEATURED
                                            badge on the listing pages.</div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Minimum Deposit Amount:</th>
                                    <td><input type="number" name="minimum" value="{{ $plan->minimum }}" class="inpts"
                                            style="width:98%" step="0.01">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Maximum Deposit Amount:</th>
                                    <td><input type="number" name="maximum" value="{{ $plan->maximum }}" class="inpts"
                                            style="width:98%" step="0.01">
                                        <div class="alert alert-warning">Set to 0 if there is no maximum</div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Referral Percentage:</th>
                                    <td><input type="number" name="referral_percentage"
                                            value="{{ $plan->referral_percentage }}" class="inpts" style="width:98%" step="0.01">
                                        <div class="alert alert-warning">Percentage an upline will be paid when referral
                                            pays for this plan.</div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Interest (percentage/frequency)</th>
                                    <td>
                                        <div style="display: flex; padding-bottom:5px;">
                                            <input type="number" name="percentage" value="{{ $plan->percentage }}"
                                                class="inpts" step="0.01">
                                            &nbsp;&nbsp;/&nbsp;&nbsp;
                                            <select name="profit_frequency" class="inpts">
                                                <option {{ $plan->profit_frequency == 'end' ? 'selected' : '' }}
                                                    value="end">End of Plan
                                                </option>
                                                <option {{ $plan->profit_frequency == 'minute' ? 'selected' : '' }}
                                                    value="minute">
                                                    Minutely
                                                </option>
                                                <option {{ $plan->profit_frequency == 'hour' ? 'selected' : '' }}
                                                    value="hour">
                                                    Hourly
                                                </option>
                                                <option {{ $plan->profit_frequency == 'day' ? 'selected' : '' }}
                                                    value="day">
                                                    Daily
                                                </option>
                                                <option {{ $plan->profit_frequency == 'week' ? 'selected' : '' }}
                                                    value="week">
                                                    Weekly
                                                </option>
                                                <option {{ $plan->profit_frequency == 'monthly' ? 'selected' : '' }}
                                                    value="month">
                                                    Monthly
                                                </option>
                                                <option {{ $plan->profit_frequency == 'year' ? 'selected' : '' }}
                                                    value="year">
                                                    Yearly
                                                </option>
                                            </select>
                                        </div>
                                        <div class="alert alert-warning">Example: If interest is 10% daily, enter 10 in
                                            the
                                            first field, and select daily from the second field
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Plan lifespan:</th>
                                    <td>
                                        <div style="display: flex; padding-bottom:5px;">
                                            <input type="number" name="duration" value="{{ $plan->duration }}"
                                                class="inpts">
                                            &nbsp;&nbsp;/&nbsp;&nbsp;
                                            <select name="duration_type" class="inpts">
                                                <option {{ $plan->duration_type == 'minute' ? 'selected' : '' }}
                                                    value="minute">Minute(s)
                                                </option>
                                                <option {{ $plan->duration_type == 'hour' ? 'selected' : '' }}
                                                    value="hour">Hour(s)
                                                </option>
                                                <option {{ $plan->duration_type == 'day' ? 'selected' : '' }}
                                                    value="day">Day(s)
                                                </option>
                                                <option {{ $plan->duration_type == 'month' ? 'selected' : '' }}
                                                    value="month">
                                                    Month(s)
                                                </option>
                                                <option {{ $plan->duration_type == 'year' ? 'selected' : '' }}
                                                    value="year">Year(s)
                                                </option>
                                            </select>
                                        </div>
                                        <div class="alert alert-warning"> This is the total lifespan of the plan before
                                            the
                                            deposit is automatically released. For example, if plan will last for 3
                                            days,
                                            enter 3 in the first field and select Day(s) from second field
                                        </div>
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
</x-template.admin>

