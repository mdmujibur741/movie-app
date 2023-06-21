<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Season;
use App\Models\TvShow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Str;

class EpisodeController extends Controller
{
    public function index($tvId, $slug)
    {
         $tvShow = TvShow::find($tvId);
         $season =  Season::where('tv_show_id', $tvId)->where('slug', $slug)->first();
        $filters = FacadesRequest::only(['search', 'perPage']);
        $inputSearch = FacadesRequest::input('search');
        $perPage = FacadesRequest::input('perPage') ?: 5;
        $episodes = Episode::query()
        ->where('season_id', $season->id)
        
        ->when($inputSearch, function($query, $search){
               $query->where('name','like', "%{$search}%");}) 
        ->latest()->paginate($perPage)->withQueryString();
         return Inertia::render('Tv-shows/Seasons/Episode/index', compact('episodes', 'tvShow', 'season', 'filters'));
    }

   public function store(Request $request, $tvShowId, $seasonId) {
      
    $season = Season::find($seasonId);
    $tvShow = TvShow::find($tvShowId);

    $episode = $season->episodes()->where('episode_number', FacadesRequest::input('episode_number'))->exists();
    if ($episode) {
        return Redirect::back()->with('message', 'Episode Exists.');
    }
    $tmdb_episode = Http::asJson()->get(config('services.tmdb.endpoint') . 'tv/' . $tvShow->tmdb_id . '/season/' . $season->season_number . '/episode/'. FacadesRequest::input('episode_number') . '?api_key=' . config('services.tmdb.secret') . '&language=en-US');

    if ($tmdb_episode->successful()) {
        Episode::create([
            'season_id' => $season->id,
            'tmdb_id' => $tmdb_episode['id'],
            'name'    => $tmdb_episode['name'],
            'slug' => Str::slug($tmdb_episode['name'], '-'),
            'episode_number' => $tmdb_episode['episode_number'],
            'overview'  => $tmdb_episode['overview'],
        ]);
        return Redirect::back()->with('message', 'Episode Create.');
    } else {
        return Redirect::back()->with('message', 'Api error.');
    }    
    }



   public function edit($tvSlug, $seasonId, $episodeId){
                      
               return Inertia::render('Tv-shows/Seasons/Episode/edit', [
                'tvShow' => TvShow::where('slug', $tvSlug)->first(),
                'season' => Season::where('id', $seasonId)->first(),
                'episode' => Episode::where('id', $episodeId)->first(),
               ]);
                
    }

        public function update (Request $request, $tvId, $seasonId, $episodeId){
            $validate =  $request->validate([
                  'name' => 'required',
                  'overview' => 'nullable',
                  'is_public' => 'required',
             ]);

             $episode = Episode::findOrFail($episodeId);
             $episode->update($validate);
             $season = Season::find($seasonId);
             return to_route('admin.episodes.index', [$tvId, $season->slug])->with('message', 'Episode Update SuccessfullY. ');
        }


       public function destroy($tvId, $seasonId, $episodeId)  {
        $episode = Episode::find($episodeId)->delete();  
        return Redirect::back()->with('message', 'Episode Deleted SuccessfullY.'); 
        }
}
