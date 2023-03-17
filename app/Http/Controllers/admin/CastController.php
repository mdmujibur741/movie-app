<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CastResource;
use App\Models\Cast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Inertia\Inertia;
use Illuminate\Support\Str;

class CastController extends Controller
{
    public function index()
    {
        $filters = FacadesRequest::only(['search', 'perPage']);
        $inputSearch = FacadesRequest::input('search');
        $perPage = FacadesRequest::input('perPage') ?: 5;
        $casts = CastResource::collection(Cast::query()
        ->when($inputSearch, function($query, $search){
               $query->where('name','like', "%{$search}%");}) 
        ->latest()->paginate($perPage)->withQueryString());
          return Inertia::render('Casts/index',compact('filters','casts'));
    }

    public function store(Request $request)
    {
       
      $cast = Cast::where('tmdb_id', $request->cast_id)->first();
      if ($cast) {
       
          return  Redirect::back()->with('message', 'Cast Exists.');
      }
   
        $tmd_cast = Http::get(config('services.tmdb.endpoint').'person/'.$request->cast_id. '?api_key='.config('services.tmdb.secret').'&language=en-US');
        if($tmd_cast->successful()){
        
             Cast::create([
                     'tmdb_id' => $tmd_cast['id'],
                      'name' => $tmd_cast['name'],
                      'slug' => Str::slug($tmd_cast['name'], '-'),
                      'poster_path' => $tmd_cast['profile_path'],
             ]);
             return Redirect::back();
        }else{
            return Redirect::back()->with('message', 'Api error');
        }
    }

    public function edit($slug)
    {
          $cast = Cast::where('slug', $slug)->first();
          return Inertia::render('Casts/edit', compact('cast'));
    }

    public function update(Request $request, $slug)
    {
         $request->validate([
             'name' => 'required',
             'poster_path' => 'required'
         ]);
          $cast = Cast::where('slug', $slug)->first();
          if($cast){
              $cast->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
                'poster_path' => $request->poster_path,
              ]);
              return to_route('admin.casts.index');
          }
    }

    public function destroy($slug)
    {
        $cast = Cast::where('slug', $slug)->first()->delete();
        return Redirect::back();
    }


}
