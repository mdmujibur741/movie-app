<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MovieController extends Controller
{
    public function index()  {  
        return Inertia::render('Frontend/movie/index',[
               'movies' => Movie::orderBy('created_at', 'desc')->with('genres')->paginate(10),
        ] );
     }


     public function show($slug) {
         $movie = Movie::where('slug', $slug)->where('is_public', 1)->with('genres')->first();
         $newMovies = Movie::where('is_public', 1)->take(6)->get();
         return Inertia::render('Frontend/movie/show',[
               'movie' => $movie,
               'newMovies' => $newMovies,
               'casts' => $movie->cast,
               'tags' => $movie->tags,
               'triller' => $movie->trillers
         ]);
     }


}
