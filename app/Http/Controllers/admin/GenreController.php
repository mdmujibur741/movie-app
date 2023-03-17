<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\GenreResource;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request as FacadesRequest;

class GenreController extends Controller
{
    public function index()
    {
        $filters = FacadesRequest::only(['search', 'perPage']);
        $inputSearch = FacadesRequest::input('search');
        $perPage = FacadesRequest::input('perPage') ?: 5;
        $genres =  GenreResource::collection(Genre::query()
        ->when($inputSearch, function($query, $search){
               $query->where('title','like', "%{$search}%");}) 
        ->latest()->paginate($perPage)->withQueryString());
          return Inertia::render('Genres/index',compact('filters','genres'));
         
    }

    public function store(Request $request)
    {
        $tmdGen = Http::get(config('services.tmdb.endpoint') . 'genre/movie/list?api_key=' . config('services.tmdb.secret') . '&language=en-US');
        if($tmdGen->successful()){
             $tmdGenJson = $tmdGen->json();

             foreach($tmdGenJson as $single){
                   foreach($single as $gen){
                         
                      $tGen = Genre::where('tmdb_id', $gen['id'])->first();
                      if(!$tGen){
                          Genre::create([
                              'tmdb_id' => $gen['id'],
                              'title' => $gen['name'],
                          ]);
                      }
                   }
             }

             return Redirect::back();
        }
    }

    public function edit($slug)
    {
          $genre = Genre::where('slug', $slug)->first();
          return Inertia::render('Genres/edit', compact('genre'));
    }

    public function update(Request $request, $slug)
    {
       
        
        $request->validate([
             'title' => 'required',
         ]);
          $genres = Genre::where('slug', $slug)->first();
          if($genres){
              $genres->update([
                'title' => $request->title,
              ]);
              return to_route('admin.genres.index');
          }
    }

    public function destroy($slug)
    {
        $genre = Genre::where('slug', $slug)->first()->delete();
        return Redirect::back();
    }

}
