<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrailerUrl extends Model
{
    use HasFactory;

    protected $fillable = ['name',	'embed_html',	'trailerable_id',	'trailerable_type'	];
}
