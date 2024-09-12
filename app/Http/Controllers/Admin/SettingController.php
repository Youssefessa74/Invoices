<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\PusherService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        return view('admin.setting.index');
    }

    public function PusherUpdate(Request $request){
        // Validate the request data
        $validatedData = $request->validate([
          'app_id' => ['required'],
          'key' => ['required'],
          'secret' =>['required'],
          'cluster'=> ['required']
        ]);


        // Update or create each key-value pair
        foreach($validatedData as $key => $value){
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }


       $PusherSettings =app(PusherService::class);
       $PusherSettings->clearCachedSettings();

        toastr('Data has been added successfully', 'success');
        return redirect()->back();
    }
}
