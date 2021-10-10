<x-layout>
    <form
        method="POST"
        action="{{ route('authenticate') }}"
        class="mx-auto max-w-xs h-screen flex flex-col justify-center space-y-8"
    >
        @csrf
        <div>
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Enter PIN
            </h3>
        </div>

        <div class="mt-6">
            <label for="pin" class="block text-sm font-medium text-gray-700">
                Pin
            </label>
            <div class="mt-1 flex rounded-md shadow-sm">
                <input type="text" name="pin" id="pin" class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-md sm:text-sm border-gray-300">
            </div>
        </div>

        <div class="flex justify-end">
            <a
                href="{{ route('dashboard') }}"
                class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Cancel
            </a>
            <button
                type="submit"
                class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Enter
            </button>
        </div>
    </form>
</x-layout>
