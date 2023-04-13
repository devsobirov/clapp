<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        if (auth()->user()->is_admin) return redirect('/admin');
        return redirect('/');
    }
}
