<?php

namespace App\Http\Controllers;

use App\Models\ChoreTask;
use App\Models\Profile;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $profile = Profile::query()->find($request->session()->get('profile'));
        return view('dashboard', [
            'profile' => $profile,
            'your_chores' => ChoreTask::with('chore')
                ->where('profile_id', $profile->id)
                ->whereNull('completed_at')
                ->get(),
            'available_chores' => ChoreTask::with('chore')
                ->whereNull('profile_id')
                ->whereNull('completed_at')
                ->get(),
        ]);
    }
}
