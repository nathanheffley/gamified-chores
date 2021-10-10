<?php

namespace App\Http\Middleware;

use App\Models\Profile;
use Closure;
use Illuminate\Http\Request;

class RequireProfile
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->missing('profile')) {
            return redirect()->route('profiles.select');
        }

        if (Profile::query()->where('id', $request->session()->get('profile'))->count() < 1) {
            return redirect()->route('profiles.select');
        }

        return $next($request);
    }
}
