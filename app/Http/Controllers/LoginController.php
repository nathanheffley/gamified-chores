<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\In;

class LoginController extends Controller
{
    public function select()
    {
        return view('login.select', [
            'profiles' => Profile::all(),
        ]);
    }

    public function Login(Profile $profile)
    {
        Session::put('profile', $profile->id);

        return redirect(route('dashboard'));
    }
}
