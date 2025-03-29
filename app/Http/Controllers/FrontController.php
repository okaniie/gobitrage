<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Exception;

class FrontController extends Controller
{
    public function index()
    {
        $plans = Plan::orderBy('ordering')->get();
        return view('pages.guest.index', compact('plans'));
    }

    public function pageView($page)
    {
        try {
            if ($page === 'investment-plans') {
                $plans = Plan::orderBy('ordering')->get();
                return view("pages.guest.{$page}", compact('plans'));
            }
            return view("pages.guest.{$page}");
        } catch (Exception $e) {
            return view("pages.guest.404");
        }
    }

    public function affiliate($ref)
    {
        //set session
        session(['ref' => $ref]);
        return redirect()->to(route('home'));
    }
}
