<?php

namespace App\Http\Controllers;

use App\Models\Chore;
use App\Models\ChoreTask;
use App\Models\Profile;
use Exception;
use Illuminate\Http\Request;

class ChoreTaskController extends Controller
{
    public function open(Chore $chore)
    {
        $chore->tasks()->create();

        return redirect()->route('dashboard');
    }

    public function claim(Request $request, ChoreTask $choreTask)
    {
        if ($choreTask->profile_id !== null) {
            throw new Exception('This chore has already been claimed!');
        }

        $choreTask->profile_id = $request->session()->get('profile');

        $choreTask->save();

        return redirect('dashboard');
    }

    public function complete(Request $request, ChoreTask $choreTask)
    {
        if ($choreTask->profile_id === null) {
            throw new Exception('This chore has not been claimed yet!');
        }

        if ($choreTask->completed_at !== null) {
            throw new Exception('This chore has already been completed!');
        }

        $profile = Profile::query()->findOrFail($request->session()->get('profile'));
        $profile->points += $choreTask->chore->points;
        $profile->save();

        $choreTask->completed_at = now();
        $choreTask->save();

        return redirect('dashboard');
    }
}
