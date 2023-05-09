<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Season;
use App\Models\TvShow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Str;

class SeasonController extends Controller
{
    public function index($id)
    {
        $tvShow =  TvShow::findOrFail($id);
        $filters = FacadesRequest::only(['search', 'perPage']);
        $inputSearch = FacadesRequest::input('search');
        $perPage = FacadesRequest::input('perPage') ?: 5;
        $seasons = Season::query()
        ->where('tv_show_id', $tvShow->id)
        ->when($inputSearch, function($query, $search){
               $query->where('name','like', "%{$search}%");}) 
        ->latest()->paginate($perPage)->withQueryString();
        return Inertia::render('Tv-shows/Seasons/index', compact('seasons', 'tvShow' ,'filters'));
    }

    public function store($tvId)
    {
        $tvShow = TvShow::findOrFail($tvId);
        $season = $tvShow->seasons()->where('season_number', FacadesRequest::input('season_number'))->exists();
        if($season){
            return  Redirect::back()->with('message', 'Season Exists.');   
        }
     
        
       $tmdb_season = Http::asJson()->get(config('services.tmdb.endpoint') . 'tv/' .  $tvShow->tmdb_id. '/season/'.FacadesRequest::input('season_number') . '?api_key=' . config('services.tmdb.secret') . '&language=en-US');
       if($tmdb_season->successful()){
            Season::create([
                      'tv_show_id' => $tvShow->id,
                      'tmdb_id' => $tmdb_season['id'],
                      'name' => $tmdb_season['name'],
                      'poster_path' => $tmdb_season['poster_path'],
                       'season_number' => $tmdb_season['season_number'],
                       'slug' => Str::slug($tmdb_season['name'])
            ]);
            return Redirect::back()->with('message', 'Season Added SuccessfullY.');
       }else{
        return Redirect::back()->with('message', 'Api error.');
    }
    }

    public function edit($tvShow, $season)
    {
          $season = Season::where('slug', $season)->first();
          return Inertia::render('Tv-shows/Seasons/edit',compact('season', 'tvShow'));
    }


    public function update(Request $request, $tvShow, $slug)
    {
      
      
         $season = Season::where('slug', $slug)->first();        

        $season->update([
            'name' => $request->name,
            'poster_path' => $request->poster_path,
          'slug' => Str::slug($request->name)
           ]);

           return to_route('admin.seasons.index', $season->tv_show_id)->with('message', 'Season Update SuccessfullY.');
    }

    public function destroy($tvShow, $slug)
    {
        $tv = Season::where('slug', $slug)->first()->delete();  
        return Redirect::back()->with('message', 'Season Deleted SuccessfullY.'); 
    }
}
