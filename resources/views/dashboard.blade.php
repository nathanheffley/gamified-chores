<x-layout>
    <nav class="p-4 md:px-8 flex items-center">
        <img
            src="{{ $profile->photo_path }}"
            alt=""
            class="w-16 h-16 rounded-full"
        >
        <div class="ml-3 flex flex-col items-start">
            <span class="font-semibold text-lg">
                {{ $profile->name }}
            </span>
            <a href="{{ route('profiles.select') }}" class="flex items-center text-gray-700">
                <svg class="h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z" />
                </svg>
                <span class="ml-1 text-sm font-semibold">
                    switch
                </span>
            </a>
        </div>
        <div class="ml-6 flex items-center text-indigo-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
            </svg>
            <span class="ml-0.5 font-semibold">
                    {{ $profile->points }} points
                </span>
        </div>

        <div class="ml-auto">
            <a href="{{ route('profiles.index') }}">
                Profiles
            </a>
            <a href="{{ route('chores.index') }}" class="ml-4">
                Chores
            </a>
            <a href="{{ route('review.show') }}" class="ml-4">
                Review
            </a>
        </div>
    </nav>

    <div class="mt-16 w-full flex flex-col items-center justify-center">
        <h2 class="text-2xl font-semibold text-gray-800">
            Your Chores
        </h2>
        <div class="mt-8 grid gap-12 sm:grid-cols-2 md:grid-cols-3">
            @forelse($your_chores as $task)
                <div>
                    <div class="w-64 aspect-w-16 aspect-h-9">
                        <img
                            src="/storage/{{ $task['photo'] }}"
                            alt=""
                            class="w-full h-full object-center object-cover rounded"
                        />
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="mt-2 block text-gray-900 font-semibold">{{ $task['title'] }}</span>
                            <span class="block text-gray-600">{{ $task['points'] }} points</span>
                        </div>

                        <form
                            method="POST"
                            action="{{ route('task.complete', $task['id']) }}"
                        >
                            @csrf
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-indigo-500 focus:text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="w-full col-span-3">
                    <span class="text-lg font-semibold text-indigo-700 whitespace-nowrap">
                        You've completed all your chores! 🎉
                    </span>
                </div>
            @endforelse
        </div>
    </div>

    <div class="mt-16 w-full flex flex-col items-center justify-center">
        <h2 class="text-2xl font-semibold text-gray-800">
            Available Chores
        </h2>
        <div class="mt-8 grid gap-12 sm:grid-cols-2 md:grid-cols-3">
            @forelse($available_chores as $task)
                <div>
                    <div class="w-64 aspect-w-16 aspect-h-9">
                        <img
                            src="/storage/{{ $task['photo'] }}"
                            alt=""
                            class="w-full h-full object-center object-cover rounded"
                        />
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="mt-2 block text-gray-900 font-semibold">{{ $task['title'] }}</span>
                            <span class="block text-gray-600">{{ $task['points'] }} points</span>
                        </div>

                        <form
                            method="POST"
                            action="{{ route('task.claim', $task['id']) }}"
                        >
                            @csrf
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-indigo-500 focus:text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="w-full col-span-3">
                    <span class="text-lg font-semibold text-indigo-700 whitespace-nowrap">
                        There are no chores left to claim! 🎉
                    </span>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>
