<x-layout>
    <nav class="h-screen w-full flex items-center justify-center">
        <div class="grid gap-12 sm:grid-cols-2 md:grid-cols-3">
            @forelse($profiles as $profile)
                <a href="{{ route('profiles.login', $profile) }}">
                    <img
                        src="{{ $profile->photo_path }}"
                        alt=""
                        class="w-32 h-32 rounded-full"
                    >
                    <span class="block mt-2 text-center text-lg font-semibold text-gray-700">
                        {{ $profile->name }}
                    </span>
                </a>
            @empty
                <p class="col-span-3 text-center">
                    You don't have any profiles yet, please
                    <a href="{{ route('profiles.create') }}" class="whitespace-nowrap text-blue-600">
                        create a profile first.
                    </a>
                </p>
            @endforelse
        </div>
    </nav>
</x-layout>
