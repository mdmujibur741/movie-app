<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = ['tmdb_id', 'season_id', 'name', 'episode_number', 'is_public', 'visits', 'slug', 'overview',] ;

    public function setTitleAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
