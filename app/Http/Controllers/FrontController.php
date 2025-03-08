<?php

namespace App\Http\Controllers;

use Exception;

class FrontController extends Controller
{
    public function index()
    {
        return view('pages.guest.index');
    }

    public function pageView($page)
    {
        try {
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
