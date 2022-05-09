<?php

namespace App\Http\Controllers;

use App\Models\ChoreTask;

class HistoryController extends Controller
{
    public function __invoke()
    {
        $tasks = ChoreTask::query()
            ->with(['chore', 'profile'])
            ->get();

        return view('history', [
            'unclaimedTasks' => $tasks->whereNull('profile_id')->whereNull('completed_at'),
            'unfinishedTasks' => $tasks->whereNotNull('profile_id')->whereNull('completed_at'),
            'doneTasks' => $tasks->whereNotNull('profile_id')->whereNotNull('completed_at'),
        ]);
    }
}
