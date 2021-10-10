<x-layout>
    <form
        method="POST"
        action="{{ route('profiles.store') }}"
        class="mx-auto max-w-xs h-screen flex flex-col justify-center space-y-8"
    >
        @csrf
        <div>
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Add New Profile
            </h3>
        </div>

        <div class="mt-6">
            <label for="name" class="block text-sm font-medium text-gray-700">
                Name
            </label>
            <div class="mt-1 flex rounded-md shadow-sm">
                <input type="text" name="name" id="name" class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-md sm:text-sm border-gray-300">
            </div>
        </div>

        <fieldset class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-y-8">
            <legend class="sr-only">
                Photo
            </legend>
            @foreach(\App\Models\Profile::PHOTO_OPTIONS as $photoOption)
                <label>
                    <input type="radio" name="photo" value="{{ $photoOption }}" class="sr-only" aria-labelledby="photo-option-{{ $photoOption }}-label">
                    <img
                        src="/imgs/profiles/{{ $photoOption }}.png"
                        alt=""
                        class="mx-auto w-32 h-32 rounded-full"
                    >
                    <span class="sr-only" id="photo-option-{{ $photoOption }}-label">
                        {{ $photoOption }} Profile Photo
                    </span>
                </label>
            @endforeach
        </fieldset>

        <div class="flex justify-end">
            <a
                href="{{ route('profiles.index') }}"
                class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Cancel
            </a>
            <button
                type="submit"
                class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Add Profile
            </button>
        </div>
    </form>
</x-layout>
