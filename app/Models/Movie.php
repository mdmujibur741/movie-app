<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Movie extends Model implements Searchable
{
    use HasFactory;
    protected $fillable = ['tmdb_id',	'title',	'release_date',	'runtime',	'lang',	'video_format',	'is_public',	'visits',	'slug',	'rating',	'poster_path',	'backdrop_path',	'overview',	];

   

    public function getSearchResult(): SearchResult
    {
        $url = route('web.movies.show', $this->slug);

        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->title,
            $url
        );
    }


    public function genres (){
         return $this->belongsToMany(Genre::class);
    }


    public function trillers()  {
        return $this->morphMany(TrailerUrl::class, 'trailerable' );
    }

    public function tags(){
        return $this->morphToMany(Tag::class,'taggable');
    }

    public function cast(){
            return $this->belongsToMany(Cast::class, 'cast_movie');
    }

}
