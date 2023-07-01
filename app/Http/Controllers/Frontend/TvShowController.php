<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Season;
use App\Models\TvShow;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TvShowController extends Controller
{
    public function index()  {
        return Inertia::render('Frontend/tvShow/index',[
            'tvShows' => TvShow::query()->withCount('seasons')->latest()->paginate(10)
        ]);
     }

     public function show($slug)  {
         $tvShow = TvShow::where('slug', $slug)->first();
         $newTvShows = TvShow::latest()->take(6)->get();
        return Inertia::render('Frontend/tvShow/seasonIndex',[
            'tvShow' => $tvShow,
            'seasons' => $tvShow->seasons,
            'newTvShows' => $newTvShows,
        ]);
     }

     public function season($tvSlug, $seasonSlug)  {
          $tvShow = TvShow::where('slug', $tvSlug)->first();
          $season = Season::where('tv_show_id', $tvShow->id)->where('slug', $seasonSlug)->first();
          $episodes = $season->episodes()->get();
          $newTvShows = TvShow::latest()->take(6)->get();
        
          return Inertia::render('Frontend/tvShow/season',[
            'tvShow' => $tvShow,'season' => $season, 'episodes' => $episodes,'newTvShows' => $newTvShows ]);

     }

     public function episode($tvSlug, $seasonSlug, $episodeSlug){
            
            return Inertia::render('Frontend/tvShow/episode',[
                 'tvShow' => TvShow::where('slug', $tvSlug)->first(),
                 'season' => $seasonSlug,
                 'episode' => Episode::where('slug', $episodeSlug)->first(),
                 'newTvShows' => TvShow::latest()->take(6)->get(),
            ]);
     }
}
