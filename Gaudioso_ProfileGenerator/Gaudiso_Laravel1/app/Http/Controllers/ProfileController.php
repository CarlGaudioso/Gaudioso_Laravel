<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = session()->get('profiles', []);
        return view('profile', ['profiles' => $profiles]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1|max:150',
            'program' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'gender' => 'required|in:male,female',
            'hobbies' => 'required|array|min:5|max:10',
            'hobbies.*' => 'string|max:100',
            'biography' => 'required|string|max:1000',
        ]);

        $profiles = session()->get('profiles', []);
        $profiles[] = [
            'id' => uniqid(),
            'name' => $validated['name'],
            'age' => $validated['age'],
            'program' => $validated['program'],
            'email' => $validated['email'],
            'gender' => $validated['gender'],
            'hobbies' => array_filter($validated['hobbies']),
            'biography' => $validated['biography'],
        ];

        session()->put('profiles', $profiles);

        return redirect()->route('profile.index')->with('success', 'Profile added successfully!');
    }

    public function destroyAll()
    {
        session()->forget('profiles');
        return redirect()->route('profile.index')->with('success', 'All profiles deleted successfully!');
    }

    public function destroy($id)
    {
        $profiles = session()->get('profiles', []);
        $profiles = array_filter($profiles, fn($profile) => $profile['id'] !== $id);
        session()->put('profiles', array_values($profiles));

        return redirect()->route('profile.index')->with('success', 'Profile deleted successfully!');
    }
}
