<?php

namespace App\Http\Controllers\Admin;

use App\Events\NewsletterEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewslettersRequest;
use App\Models\Deposit;
use App\Models\Plan;
use App\Models\User;

class NewslettersController extends Controller
{
    public function index()
    {
        return view('pages.admin.newsletter', [
            'plans' => Plan::all()
        ]);
    }

    public function queueNewsletter(NewslettersRequest $request)
    {
        $validated = $request->validated();

        if ($validated['to'] === "user" && empty($validated['username'])) {
            return back()->with("error", "You must provide a username to send to user.");
        }

        if ($validated['to'] === "user") {
            $user = User::where(['username' => $validated['username'], 'user_type' => 'user'])->get();
            if (empty($user->first())) return back()->with("error", "User with specified username not found.");
            $recipients = $user;
        }

        if ($validated['to'] == "all") {
            $recipients = User::where('user_type', 'user')->get();
        }

        if ($validated['to'] == "active") {
            $r = Deposit::select('user_id')->groupBy('user_id')->get()->pluck('user_id')->toArray();

            if (empty($r)) {
                return back()->with("error", "Users not found for selected group");
            }

            $recipients = User::where('user_type', 'user')->whereIn('id', $r)->get();
        }

        if ($validated['to'] == "inactive") {
            $r = Deposit::select('user_id')->groupBy('user_id')->get()->pluck('user_id')->toArray();
            if (empty($r)) {
                return back()->with("error", "Users not found for selected group");
            }
            $recipients = User::where('user_type', 'user')->whereNotIn('id', $r)->get();
        }

        if (preg_match("(plan_)", $validated['to'])) {
            $plan_id = explode("_", $validated['to'])[1];

            $r = Deposit::where('plan_id', $plan_id)->select('user_id')->groupBy('user_id')->get()->pluck('user_id')->toArray();
            if (empty($r)) {
                return back()->with("error", "No deposits found for selected plan.");
            }

            $recipients = User::whereIn('id', $r)->get();
        }

        NewsletterEvent::dispatch($recipients, $validated['subject'], $validated['message']);

        // if (empty($save)) $message = "Unable to schedule newsletter sending at the moment. Please try again later.";
        return back()->with('success', "Newsletter sent or added to queue successfully.");
    }
}
