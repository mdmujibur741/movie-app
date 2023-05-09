<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Season;
use App\Models\TvShow;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request as FacadesRequest;

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
}
