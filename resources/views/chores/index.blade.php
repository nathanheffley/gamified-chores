<x-layout>
    <div class="mt-16 w-full flex flex-col items-center justify-center">
        <a href="{{ route('dashboard') }}" class="text-lg font-semibold text-blue-600 hover:underline">
            Back to dashboard
        </a>
        <div class="mt-8 grid gap-12 sm:grid-cols-2 md:grid-cols-3">
            @foreach($chores as $chore)
                <div>
                    <div class="w-64 aspect-w-16 aspect-h-9">
                    <img
                        src="/storage/{{ $chore->photo }}"
                        alt=""
                        class="w-full h-full object-center object-cover rounded"
                    />
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="mt-2 block text-gray-900 font-semibold">{{ $chore->title }}</span>
                            <span class="block text-gray-600">{{ $chore->points }} points</span>
                        </div>

                        <form
                            method="POST"
                            action="{{ route('task.open', $chore) }}"
                        >
                            @csrf
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-indigo-500 focus:text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V8z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach

            <div class="pb-8">
                <a href="{{ route('chores.create') }}">
                    <span class="ml-14 w-36 h-36 bg-gray-200 rounded flex items-center justify-center">
                        <svg class="h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </span>
                    <span class="sr-only">
                        Add New Chore
                    </span>
                </a>
            </div>
        </div>
    </div>
</x-layout>
