<x-layout>
    <div class="mt-16 w-full flex flex-col items-center justify-center">
        <a href="{{ route('dashboard') }}" class="text-lg font-semibold text-blue-600 hover:underline">
            Back to dashboard
        </a>

        <h2>Unclaimed</h2>
        <table>
            <tr>
                <th>Chore</th>
                <th>Time Spent Unclaimed</th>
            </tr>
            @foreach($unclaimedTasks as $task)
                <tr>
                    <td>{{ $task->chore->title }}</td>
                    <td>{{ now()->diffInSeconds($task->created_at) }}s</td>
                </tr>
            @endforeach
        </table>

        <h2>Unfinished</h2>
        <table>
            <tr>
                <th>Chore</th>
                <th>Time Spent Unfinished</th>
            </tr>
            @foreach($unfinishedTasks as $task)
                <tr>
                    <td>{{ $task->chore->title }}</td>
                    <td>{{ now()->diffInSeconds($task->updated_at) }}s</td>
                </tr>
            @endforeach
        </table>

        <h2>Done</h2>
        <table>
            <tr>
                <th>Chore</th>
                <th>Time Spent Unclaimed</th>
                <th>Time Spent Unfinished</th>
            </tr>
            @foreach($doneTasks as $task)
                <tr>
                    <td>{{ $task->chore->title }}</td>
                    <td>{{ $task->completed_at->diffInSeconds($task->created_at) }}s</td>
                </tr>
            @endforeach
        </table>
    </div>
</x-layout>
