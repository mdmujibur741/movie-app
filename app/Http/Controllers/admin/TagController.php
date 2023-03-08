<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagstoreRequest;
use App\Http\Requests\TagUpdateRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Request;

use Inertia\Inertia;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {
        $filters = Request::only('search','perPage');
        $inputSearch = Request::input('search');
        $perPage = Request::input('perPage') ?: 5;
        $tags = TagResource::collection(Tag::query()
        ->when($inputSearch, function($query, $search){
               $query->where('tag_name','like', "%{$search}%");}) 
        ->latest()->paginate($perPage)->withQueryString());
        return Inertia::render('Tags/index', compact('tags','filters'));
    }

    public function store(TagstoreRequest $request)
    {
          
          Tag::create([
                'tag_name' => $request->tag_name,
                'slug' => Str::slug($request->tag_name, '-'),
          ]);
          return to_route('admin.tags.index');
    }

    public function edit($slug)
    {
        $tag = Tag::where('slug', $slug)->first();
        return Inertia::render('Tags/edit', compact('tag'));
    }


    public function update(TagUpdateRequest $request, $slug)
    {
           $tag = Tag::where('slug', $slug)->first();
           $tag->update([
            'tag_name' => $request->tag_name,
            'slug' => Str::slug($request->tag_name, '-'),
           ]);

           return to_route('admin.tags.index');
    }
}
