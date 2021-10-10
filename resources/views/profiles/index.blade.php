<x-layout>
    <div class="mt-16 w-full flex flex-col items-center justify-center">
        <a href="{{ route('dashboard') }}" class="text-lg font-semibold text-blue-600 hover:underline">
            Back to dashboard
        </a>
        <div class="mt-8 grid gap-12 sm:grid-cols-2 md:grid-cols-3">
            @foreach($profiles as $profile)
                <div>
                    <img
                        src="{{ $profile->photo_path }}"
                        alt=""
                        class="w-32 h-32 rounded-full"
                    >
                    <div class="mt-2 flex justify-center">
                        <span class="text-lg font-semibold text-gray-700">
                            {{ $profile->name }}
                        </span>

                        <form method="POST" action="{{ route('profiles.destroy', $profile) }}" class="flex items-center">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class=""
                            >
                                <svg class="ml-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                <span class="sr-only">
                                    Delete {{ $profile->name }}'s Profile
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach

            <div class="pb-8">
                <a href="{{ route('profiles.create') }}">
                    <span class="w-32 h-32 bg-gray-200 rounded-full flex items-center justify-center">
                        <svg class="h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </span>
                    <span class="sr-only">
                        Add New Profile
                    </span>
                </a>
            </div>
        </div>
    </div>
</x-layout>
