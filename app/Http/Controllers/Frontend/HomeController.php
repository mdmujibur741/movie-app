<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\TvShow;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function home(){
        return Inertia::render('Frontend/index',[
            'movies' => Movie::query()->with('genres')->latest()->take(10)->get(),
            'tvShows' => TvShow::query()->withCount('seasons')->latest()->take(10)->get()
        ]);
    }
}
