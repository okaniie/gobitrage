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
        try {
            $plan = Plan::findOrFail($id);
            
            // Check if there are any active deposits using this plan
            if ($plan->deposits()->where('status', 'active')->exists()) {
                return back()->with('error', 'Cannot delete plan: There are active deposits using this plan.');
            }

            $planName = $plan->title;
            $plan->delete();
            
            return back()->with('success', "Investment plan '{$planName}' was deleted successfully.");
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return back()->with('error', 'Investment plan not found.');
        } catch (\Exception $e) {
            \Log::error('Failed to delete plan: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete plan. Please try again or contact support if the problem persists.');
        }
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
