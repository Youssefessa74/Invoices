<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChangePassowrdRequest;
use App\Http\Requests\Admin\EditProfileRequest;
use App\Models\User;
use App\Traits\upload_file;
use App\Traits\Upload_image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    use upload_file;
    public function index(){
        $profiledata = Auth::user();
        return view('admin.profile.index',compact('profiledata'));
    }

    public function EditProfile(EditProfileRequest $request){

        $user = User::findOrFail($request->id);
        $user->name = $request->name;
        $user->email =$request->email;
        $imagepath = $this->uploadFile($request,'avatar');
        $user->avatar = isset($imagepath) ?  $imagepath : $user->avatar;
        $user->save();
        toastr('Data has been Updated Successfully','success');

        return redirect()->back();
    }

    public function changePassword(ChangePassowrdRequest $request)
    {
        $user = Auth::user(); // Get the currently authenticated user

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        // Optionally, you can redirect with a success message
        toastr('Password updated successfully', 'success');
        return redirect()->back();
    }

}

