<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GenresController extends Controller
{
   public function index($slug) {
      $genre = Genre::where('slug', $slug)->first();
      //return $genre;
         return Inertia::render('Frontend/genre/index',[
               'genre' =>$slug,
               'movies' => $genre->movie()->paginate(10),
         ]);
    }
}
