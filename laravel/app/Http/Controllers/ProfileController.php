<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::all();
        return view('profile.index', compact('profiles'));
    }

    public function indexTwo()
    {
        $profiles = Profile::all();
        return view('profile.index2', compact('profiles'));
    }

    public function showForm()
    {
        return view('profile.form');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'grade' => 'nullable|string|in:大学1年,大学2年,大学3年,大学4年',
            'university' => 'nullable|string|max:255',
            'profile_photo_path' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'joining_date' => 'required|date',
            'comment' => 'required|string|max:255',
            'hobbies' => 'required|string|max:255',
            'mbti' => 'nullable|string|in:INTJ,INTP,ENTJ,ENTP,INFJ,INFP,ENFJ,ENFP,ISTJ,ISFJ,ESTJ,ESFJ,ISTP,ISFP,ESTP,ESFP',
            'high_school' => 'required|string|max:255',
            'hometown' => 'required|string|max:255',
            'birthday' => 'required|date',
            'motto' => 'required|string|max:255',
            'restaurants' => 'required|string|max:255',
            'club_activities' => 'required|string|max:255',
            'famous_person' => 'required|string|max:255',
            'artists' => 'required|string|max:255',
            'if_ceo' => 'required|string|max:255',
        ]);
        if ($request->hasFile('profile_photo_path')) {
            $filePath = $request->file('profile_photo_path')->store('profile_photo', 'public');
            $validatedData['profile_photo_path'] = $filePath;
        }

        Profile::create($validatedData);

        return redirect()->route('profiles.thanks')->with('success', 'Profile created successfully.');



    }

    public function thanks()
    {
        return view('profile.thanks');
    }
}
