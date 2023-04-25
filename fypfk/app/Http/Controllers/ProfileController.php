<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\infoprofile;

class ProfileController extends Controller
{
    //authorize session from user type
    public function loadProfile($id)
    {
        $user = User::find($id);
        return view('profile.studentprofile', ['user' => $user]);
        
    }

    public function updateProfile(Request $request, $id) //request apa value input from user untk update, insert
    {
        $user = User::find($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->numPhone = $request->input('numPhone');
        $user->matric = $request->input('matric');

        $user->update();

        return redirect()->back()->with('message', 'Profile Updated Successfully');
    }
}
