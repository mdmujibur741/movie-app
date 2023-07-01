<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cast;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CastController extends Controller
{
    public function index()  {
     
        return Inertia::render('Frontend/cast/index',[
            'casts' => Cast::orderBy('created_at', 'desc')->paginate(10),
        ]);
     }
}
