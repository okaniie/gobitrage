<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanCreateRequest;
use App\Http\Requests\PlanUpdateRequest;
use App\Models\Plan;
use App\Models\PlanCategory;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    public function index()
    {
        return view('pages.admin.plans.index', ['plans' => Plan::all()]);
    }

    public function viewSingle($id)
    {
        $plan = Plan::findOrFail($id);
        $plan_category_title = PlanCategory::findOrFail($plan->plan_category_id)->title;
        return view('pages.admin.plans.view', [
            'plan' => Plan::find($id),
            'plan_category_title' => $plan_category_title,
            'plan_categories' => PlanCategory::all()
        ]);
    }

    public function delete($id)
    {
        Plan::find($id)->delete();
        return back()->with('success', 'Plan deleted successfully.');
    }

    public function update(PlanUpdateRequest $request, $id)
    {
        Plan::find($id)->update($request->validated());
        return back()->with('success', "Plan saved successfully");
    }

    public function store()
    {
        $plan_category_title = PlanCategory::findOrFail(request('plan_category_id', 0))->title;
        return view('pages.admin.plans.new', [
            'plan_categories' => PlanCategory::all(),
            'plan_category_title' => $plan_category_title
        ]);
    }

    public function create(PlanCreateRequest $request)
    {
        Plan::create($request->validated());
        return redirect()
            ->route('admin.plan-categories')
            ->with('success', "Plan created successfully");
    }
}
