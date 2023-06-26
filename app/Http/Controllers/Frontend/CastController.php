<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CastController extends Controller
{
    public function index()  {
        return "ok";
        return Inertia::render('Frontend/cast/index');
     }
}
