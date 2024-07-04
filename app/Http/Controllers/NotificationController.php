<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Response;

class NotificationController extends \Illuminate\Routing\Controller
{
    public function index(Request $request)
    {
        return inertia(
            'Notification/Index',
            [
                'notifications'=> $request->user()->notifications()->paginate(10)
            ]
        );
    }
}
