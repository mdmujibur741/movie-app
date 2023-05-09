<?php

use App\Http\Controllers\admin\CastController;
use App\Http\Controllers\admin\EpisodeController;
use App\Http\Controllers\admin\GenreController;
use App\Http\Controllers\admin\MovieController;
use App\Http\Controllers\admin\SeasonController;
use App\Http\Controllers\admin\TagController;
use App\Http\Controllers\admin\TvShowController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
         Auth()->user()->assignRole('admin');
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::middleware(['auth:sanctum', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function ()
    {
        return Inertia::render('admin/index');
    })->name('index');
    Route::resource('movies', MovieController::class);
    Route::resource('tv-shows', TvShowController::class);
    Route::resource('series/{tv_shows}/seasons', SeasonController::class);
    Route::resource('series/{tv_shows}/seasons/{season}/episodes', EpisodeController::class);
    Route::resource('genres', GenreController::class);
    Route::resource('casts', CastController::class);
    Route::resource('tags', TagController::class);
});



