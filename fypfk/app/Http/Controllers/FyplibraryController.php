<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FyplibraryController extends Controller
{
    public function loadFypLibrary()
    {
        return view('fyplibrary.listfyp'); 
    }
}
