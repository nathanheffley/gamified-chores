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

    public function approve(ChoreTask $choreTask)
    {
        $choreTask->approved_at = now();
        $choreTask->save();

        return redirect('review');
    }

    public function reject(ChoreTask $choreTask)
    {
        $choreTask->completed_at = null;
        $choreTask->save();

        $profile = $choreTask->profile;
        $profile->points -= $choreTask->chore->points;
        $profile->save();

        return redirect('review');
    }

    public function review()
    {
        return view('review', [
            'tasks' => ChoreTask::with('chore', 'profile')
                ->whereNotNull('completed_at')
                ->whereNull('approved_at')
                ->get()
                ->map(fn ($task) => [
                    'id' => $task->id,
                    'photo' => $task->chore->photo,
                    'title' => $task->chore->title,
                    'points' => $task->chore->points,
                    'name' => $task->profile->name,
                    'completed_at' => $task->completed_at->diffForHumans(),
                ]),
        ]);
    }
}
