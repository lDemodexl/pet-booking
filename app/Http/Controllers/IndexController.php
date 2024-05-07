<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        // dd(Auth::user());
        return inertia('Index/Index',
        [
            'message' => 'Hello Massage'
        ]
        );
    }

    public function show()
    {
        return inertia('Index/Show');
    }
}
