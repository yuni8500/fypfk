<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //authorize session from user type
    public function loadProfile()
    {
        $category = Auth::user()->category;

        if ($category == 'Student') {
            return view('profile.studentprofile');
        }
    }
}
