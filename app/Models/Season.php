<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Season extends Model
{
    use HasFactory;

    protected $fillable = ['tmdb_id', 'tv_show_id',	'name',	'season_number', 'slug', 'poster_path'];

    public function setTitleAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function episodes()  {
        return $this->hasMany(Episode::class);
    }

}
