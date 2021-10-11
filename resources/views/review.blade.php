<x-layout>
    <div class="mt-16 w-full flex flex-col items-center justify-center">
        <div class="max-w-4xl grid gap-12 sm:grid-cols-2 md:grid-cols-3">
            @forelse($tasks as $task)
                <div>
                    <div class="w-64 aspect-w-16 aspect-h-9">
                        <img
                            src="/storage/{{ $task['photo'] }}"
                            alt=""
                            class="w-full h-full object-center object-cover rounded"
                        />
                    </div>
                    <div class="mt-2 flex items-start">
                        <div class="flex-grow pr-4">
                            <span class=" block text-gray-900 font-semibold">{{ $task['title'] }}</span>
                            <span class="block text-gray-600">{{ $task['points'] }} points</span>
                            <span class="block text-gray-900">{{ $task['name'] }} completed this {{ $task['completed_at'] }}</span>
                        </div>

                        <form
                            method="POST"
                            action="{{ route('review.reject', $task['id']) }}"
                            class="mt-2 ml-auto"
                        >
                            @csrf
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-red-500 focus:text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM14 9.667v-5.43a2 2 0 00-1.105-1.79l-.05-.025A4 4 0 0011.055 2H5.64a2 2 0 00-1.962 1.608l-1.2 6A2 2 0 004.44 12H8v4a2 2 0 002 2 1 1 0 001-1v-.667a4 4 0 01.8-2.4l1.4-1.866a4 4 0 00.8-2.4z" />
                                </svg>
                            </button>
                        </form>

                        <form
                            method="POST"
                            action="{{ route('review.approve', $task['id']) }}"
                            class="mt-1 ml-2"
                        >
                            @csrf
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-green-500 focus:text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center">
                    <p class="text-lg font-semibold text-gray-700 whitespace-nowrap">
                        You've reviewed all the chores! 🎉
                    </p>
                    <a href="{{ route('dashboard') }}" class="block mt-4 text-lg font-semibold text-blue-600 hover:underline">
                        Back to dashboard
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>
