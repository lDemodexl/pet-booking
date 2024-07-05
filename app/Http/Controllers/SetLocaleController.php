<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class SetLocaleController extends Controller
{
    public function locale(Request $request, $locale)
    {
        // set locale to session
        Session::put('locale', $locale);
        return Inertia::location(redirect()->back());;
    }
}
