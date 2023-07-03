<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class SettingController extends Controller
{
   public function create() {
          $setting = Setting::first() ?? null;
          return Inertia::render('setting/edit',['setting' => $setting]);
    }


   public function store(Request $request)  {
    
          $request->validate([
               'name' => 'required|max:240',
               'facebook' => 'required|max:240',
                'github' => 'required'
          ]);

         if($request->hasFile('logo')){
              $logo = '/storage/'. $request->file('logo')->store('image', 'public');
         }else{
              $logo = null;
         }

         if($request->hasFile('favicon')){
               $favicon = '/storage/'. $request->file('favicon')->store('image', 'public');
         }

         Setting::create([
            'name' =>$request->name,
            'logo' =>$logo,
            'favicon' =>$favicon,
            'facebook' =>$request->facebook,
            'github' =>$request->github,

         ]);
         return Redirect::back()->with('message', 'Setting Added SuccessfullY');
    }

    public function update(Request $request, $id)  {
       
        $setting = Setting::find($id);
        $request->validate([
             'name' => 'required|max:240',
             'facebook' => 'required|max:240',
              'github' => 'required'
        ]);

        if($request->hasFile('logo')){
          if($setting->logo){
             Storage::delete($setting->logo);
             
          }
        $logo = '/storage/'. $request->file('logo')->store('image', 'public');
          }else{
        $logo = $setting->logo;
          }

          if($request->hasFile('favicon')){
               if($setting->favicon){
                  Storage::delete($setting->favicon);
                  
               }
             $favicon = '/storage/'. $request->file('favicon')->store('image', 'public');
               }else{
             $favicon = $setting->favicon;
               }

       $setting->update([
          'name' =>$request->name,
          'logo' =>$logo,
          'favicon' =>$favicon,
          'facebook' =>$request->facebook,
          'github' =>$request->github,

       ]);
       return Redirect::back()->with('message', 'Setting Added SuccessfullY');
  }
}
