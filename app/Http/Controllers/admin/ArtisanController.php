<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ArtisanController extends Controller
{
    public function storageLink(){
         Artisan::call('storage:link');
         echo 'Storage linked successfully';
    }
}
