<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use App\Models\Movie;
use App\Models\Tag;
use App\Models\TrailerUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class MovieAttachController extends Controller
{
    public function index(Movie $movie){

   
         return Inertia::render('Movies/attach',
         ['movie'=>$movie, 'trillers' => $movie->trillers, 'casts' => Cast::all('id', 'name'), 'tags' => Tag::all('tag_name', 'id'), 'movieCast' => $movie->cast()->get(), 'movieTag' => $movie->tags()->get() ]);
    }


    public function addTriller(Request $request, Movie $movie){
        $movie->trillers()->create($request->validate([
              'name' => 'required',
              'embed_html' => 'required',
         ]));
         return Redirect::back()->with('message', 'Triller SuccessfullY.');
     
    }


    public function destroyTriller($id){
          $triller = TrailerUrl::find($id)->delete();
          return Redirect::back()->with('message', 'Triller Delete SuccessfullY.');
    }



    public function addCast(Request $request, Movie $movie){
  
         $request->validate([
            'cast' => 'required'
         ]);

       
         $castId = $request->cast;
        
         $movie->cast()->sync($castId);
         return Redirect::back()->with('message', 'Cast add successfullY !');
         
    }



    public function addTag(Request $request, Movie $movie){
           $request->validate([
                'tag' => 'required',
           ]);
           
           $tagId = $request->tag;
           $movie->tags()->sync($tagId);
           return Redirect::back()->with('message', 'Tag add successfullY !');
    }
}
