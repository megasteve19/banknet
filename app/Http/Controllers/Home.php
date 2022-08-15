<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class Home extends Controller
{
    /**
     * Index page.
     */
    public function index()
    {
        return Inertia::render('Welcome');
    }
}
