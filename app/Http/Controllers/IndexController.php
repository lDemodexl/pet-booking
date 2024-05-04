<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
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
