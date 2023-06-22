<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    public function index()
    {
        
        $filters = FacadesRequest::only(['search', 'perPage']);
        $inputSearch = FacadesRequest::input('search');
        $perPage = FacadesRequest::input('perPage') ?: 5;
      
        $movies = Movie::query()
         ->when($inputSearch, function($query, $search){
                $query->where('title','like', "%{$search}%");}) 
                ->latest()->paginate($perPage)->withQueryString();
    
        return Inertia::render('Movies/index', compact('movies' ,'filters'));
    }


   public function store()  {
    $movie = Movie::where('tmdb_id',FacadesRequest::input('movieTMDBId'))->exists();
    if ($movie) {
        return Redirect::back()->with('message', 'Movie Exists.');
    }

    $getMovie = Http::asJson()->get(config('services.tmdb.endpoint').'movie/'. FacadesRequest::input('movieTMDBId'). '?api_key=' . config('services.tmdb.secret') . '&language=en-US');
     
    if ($getMovie->successful()) {

        $created_movie = Movie::create([
            'tmdb_id' => $getMovie['id'],
            'title' => $getMovie['title'],
            'slug' => Str::slug($getMovie['title'], '-'),
            'runtime' => $getMovie['runtime'],
            'rating' => $getMovie['vote_average'],
            'release_date' => $getMovie['release_date'],
            'lang' => $getMovie['original_language'],
            'video_format' => 'HD',
            'is_public' => false,
            'overview' => $getMovie['overview'],
            'poster_path' => $getMovie['poster_path'],
            'backdrop_path' => $getMovie['backdrop_path']
        ]);
        $tmdb_genres = $getMovie['genres'];
        $tmdb_genres_ids = collect($tmdb_genres)->pluck('id');
        $genres = Genre::whereIn('tmdb_id', $tmdb_genres_ids)->get();
        $created_movie->genres()->attach($genres);
        return Redirect::back()->with('message', 'Movie create.');

    } else {
        return Redirect::back()->with('message', 'Api Error.');

    }
    }


   public function edit(Movie $movie)  {
    return Inertia::render('Movies/edit', compact('movie'));
    }



    public function update(Request $request , Movie $movie){
           $validate =  $request->validate([
                'title' => 'required',
                'release_date' => 'required',
                'poster_path' => 'nullable',
                'is_public' => 'required',
             ]);
         $movie->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'release_date' => $request->release_date,
            'poster_path' => $request->poster_path,
            'is_public' => $request->is_public,
         ]);
         return to_route('admin.movies.index')->with('message', 'Movie Update successfullY');
    }

    public function destroy(Movie $movie){
         $movie->genres()->sync([]);
         $movie->delete();
         return to_route('admin.movies.index')->with('message', 'Movie Delete successfullY');
    }
}
