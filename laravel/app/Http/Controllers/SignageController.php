<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\File;

class SignageController extends Controller
{
    public function index(){
        $images = File::where('status', 1)->get();
        $profiles = Profile::all();
        return view('signage.index', compact('images', 'profiles'));
    }
}
