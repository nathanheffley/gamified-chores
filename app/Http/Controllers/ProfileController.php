<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profiles.index', [
            'profiles' => Profile::all(),
        ]);
    }

    public function create(Request $request)
    {
        return view('profiles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'photo' => [
                'required',
                new In(Profile::PHOTO_OPTIONS),
            ],
        ]);

        Profile::query()->create([
            'name' => $validated['name'],
            'photo' => $validated['photo'],
        ]);

        return redirect()->route('profiles.index');
    }

    public function destroy(Profile $profile)
    {
        $profile->delete();

        return redirect()->route('profiles.index');
    }
}
