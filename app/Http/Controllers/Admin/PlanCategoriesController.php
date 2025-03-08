<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\PlanCategory;
use Illuminate\Http\Request;

class PlanCategoriesController extends Controller
{
    public function index()
    {
        return view('pages.admin.plan-categories', ['plan_categories' => $this->getInvestmentPackages()]);
    }

    public function getInvestmentPackages()
    {
        $categories = PlanCategory::orderBy('ordering')->get()->all();
        foreach ($categories as $category) {
            $category->plans = Plan::where('plan_category_id', $category->id)->get();
        }

        return $categories;
    }

    public function delete($id)
    {
        $category = PlanCategory::findOrFail($id);
        Plan::where('plan_category_id', $category->id)->delete();
        $category->delete();
        return back()->with('success', 'Plan category deleted successfully.');
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string'
        ]);


        PlanCategory::create(array_merge($request->all(), ['ordering' => $this->getNextOrder()]));
        return back()->with('success', "Plan Category created successfully.");
    }

    private function getNextOrder()
    {
        $last = PlanCategory::orderBy('ordering')->get()->last();
        return !empty($last) ? $last->ordering + 1 : 1;
    }

    public function move($id, $dir)
    {

        // get all packages
        // make sure it exists
        PlanCategory::findOrFail($id);

        $categories = PlanCategory::orderBy('ordering')
            ->get()->all();

        $copy = [];

        foreach ($categories as $key => $value) {

            if ($value->id == $id) {
                if ($dir == 'up')
                    $copy["a" . ($key - 1.1)] = $value;
                else
                    $copy["a" . ($key + 1.1)] = $value;
            } else {
                $copy["a" . $key] = $value;
            }
        }

        ksort($copy);

        $new_values = array_values($copy);

        /**
         * @var \App\Models\PlanCategory
         */
        foreach ($new_values as $key => $new_value) {
            $new_value->update(['ordering' => $key + 1]);
        }

        return back()->with("success", "Package moved successfully.");
    }
}
