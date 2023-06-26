<?php

use App\Http\Controllers\admin\CastController;
use App\Http\Controllers\admin\EpisodeController;
use App\Http\Controllers\admin\GenreController;
use App\Http\Controllers\admin\MovieController;
use App\Http\Controllers\admin\SeasonController;
use App\Http\Controllers\admin\TagController;
use App\Http\Controllers\admin\TvShowController;
use App\Http\Controllers\Frontend\CastController as FrontendCastController;
use App\Http\Controllers\Frontend\GenresController as FrontendGenresController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\MovieController as FrontendMovieController;
use App\Http\Controllers\Frontend\TvShowController as FrontendTvShowController;
use App\Http\Controllers\MovieAttachController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;




// admin Route

Route::middleware([ 'auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
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
    Route::get('movies/{movie}/attach', [MovieAttachController::class, 'index'])->name('movies.attach');
    Route::post('movies/{movie}/add-triller', [MovieAttachController::class, 'addTriller'])->name('movies.addTriller');
    Route::delete('movies/triller/{triller}', [MovieAttachController::class, 'destroyTriller'])->name('triler.destroy');
    Route::post('movies/{movie}/add-cast', [MovieAttachController::class, 'addCast'])->name('movies.addCast');
    Route::delete('movies/cast/{cast}', [MovieAttachController::class, 'destroyTriller'])->name('cast.destroy');
    Route::post('movies/{movie}/add-tag', [MovieAttachController::class, 'addTag'])->name('movies.addTag');

    Route::resource('tv-shows', TvShowController::class);
    Route::resource('series/{tv_shows}/seasons', SeasonController::class);
    Route::resource('series/{tv_shows}/seasons/{season}/episodes', EpisodeController::class);
    Route::resource('genres', GenreController::class);
    Route::resource('casts', CastController::class);
    Route::resource('tags', TagController::class);
});



// Frontend route
Route::get('/', [HomeController::class, 'home'])->name('web.home');
Route::get('/movies', [FrontendMovieController::class, 'index'])->name('web.movies');
Route::get('/movies/{slug}', [FrontendMovieController::class, 'show'])->name('web.movies.show');
Route::get('/series', [FrontendTvShowController::class, 'index'])->name('web.tvShows');
Route::get('/series/{slug}', [FrontendTvShowController::class, 'show'])->name('web.tvShows.show');
Route::get('/series/{tvSlug}/season/{seasonSlug}', [FrontendTvShowController::class, 'season'])->name('web.tvShows.seasons');
Route::get('/series/{tvSlug}/season/{seasonSlug}/episode/{episodeSlug}', [FrontendTvShowController::class, 'Episode'])->name('web.tvShows.episodes');
Route::get('/casts', [FrontendCastController::class, 'index'])->name('web.casts');
 Route::get('/casts/{slug}', [FrontendCastController::class, 'show'])->name('web.cast.show');
//Route::get('/genre/{slug}', [FrontendGenresController::class, 'show'])->name('web.genres.show');


