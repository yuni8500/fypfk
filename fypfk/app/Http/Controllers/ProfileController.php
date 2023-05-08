<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\infoprofile;

class ProfileController extends Controller
{
    //authorize session from user type
    public function loadProfile($id)
    {
        $category = Auth::user()->category;
        $user = User::find($id);

        if ($category == 'Student') {
            return view('profile.studentprofile', ['user' => $user]);
        }
        if ($category == 'Staff') {
            return view('profile.staffprofile', ['user' => $user]);
        }
        if ($category == 'Admin') {
            //dd(Auth::user()->id);
            return view('dashboard.admin');
        }
        
    }

    public function updateProfile(Request $request, $id) //request apa value input from user untk update, insert
    {
        $user = User::find($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->numPhone = $request->input('numPhone');
        $user->matric = $request->input('matric');
        $user->course_group = $request->input('course');

        $user->update();

        return redirect()->back()->with('message', 'Profile Updated Successfully');
    }
}
