<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class DefaultController extends Controller
{
    public function index()
    {
        return Inertia::render('Default/Index', [
            'data' => [
                'id' => 15,
            ],
        ]);
    }
}
