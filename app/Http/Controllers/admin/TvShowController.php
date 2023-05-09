<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\TvShowResource;
use App\Models\TvShow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Str;

class TvShowController extends Controller
{
    public function index()
    {
        $filters = FacadesRequest::only(['search', 'perPage']);
        $inputSearch = FacadesRequest::input('search');
        $perPage = FacadesRequest::input('perPage') ?: 5;
        $tvShows = TvShowResource::collection(TvShow::query()
        ->when($inputSearch, function($query, $search){
               $query->where('name','like', "%{$search}%");}) 
        ->latest()->paginate($perPage)->withQueryString());
          return Inertia::render('Tv-shows/index',compact('filters','tvShows'));
    }

    public function store()
    {
         $tvShowId = FacadesRequest::input('tvShow_id');
         $tvShow = TvShow::where('tmdb_id', $tvShowId)->first();
        if($tvShow){
            return  Redirect::back()->with('message', 'Tv show Exists.');
        }
         
        $tmdb_tv = Http::asJson()->get(config('services.tmdb.endpoint') . 'tv/' .  $tvShowId . '?api_key=' . config('services.tmdb.secret') . '&language=en-US');
        if($tmdb_tv->successful()){
             TvShow::create([
                       'tmdb_id' => $tmdb_tv['id'],
                       'name' => $tmdb_tv['name'],
                       'poster_path' => $tmdb_tv['poster_path'],
                     'created_year' => $tmdb_tv['first_air_date'],
                     'slug' => Str::slug($tmdb_tv['name'])
             ]);

             return Redirect::back()->with('message', 'Tv Added SuccessfullY.');
        }else{
            return Redirect::back()->with('message', 'Api error.');
        }
    }


    public function edit($slug)
    {
          $tv_show = TvShow::where('slug', $slug)->first();
          return Inertia::render('Tv-shows/edit',compact('tv_show'));
    }


    public function update(Request $request, $slug)
    {
         $tv = TvShow::where('slug', $slug)->first();        

        $tv->update([
            'name' => $request->name,
            'poster_path' => $request->poster_path,
          'created_year' => $request->first_air_date,
          'slug' => Str::slug($request->name)
           ]);

           return to_route('admin.tv-shows.index');
    }

    public function destroy($slug)
    {
        $tv = TvShow::where('slug', $slug)->first()->delete();  
        return Redirect::back(); 
    }
}
