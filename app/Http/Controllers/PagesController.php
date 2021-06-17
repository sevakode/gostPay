<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
    public function index()
    {
        $page_title = 'Dashboard';
        $page_description = $page_title;

        return view('pages.dashboard', compact('page_title', 'page_description'));
    }

    // Quicksearch Result
    public function quickSearch()
    {
        return view('layout.partials.extras._quick_search_result');
    }
}
