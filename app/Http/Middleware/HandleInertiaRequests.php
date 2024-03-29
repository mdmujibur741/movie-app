<?php

namespace App\Http\Middleware;

use App\Models\Genre;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'is_admin' =>$request->user() ? $request->user()->hasRole('admin') :false,
            'flash' => [
                 'message' => session('message')
            ],
            'genres' => Genre::select('id', 'title', 'slug')->get(),
            'setting' => Setting::select( 'name', 'logo', 'favicon', 'github', 'facebook')->first(),
        ]);
    }
}
