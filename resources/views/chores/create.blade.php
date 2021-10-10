<x-layout>
    <form
        method="POST"
        enctype="multipart/form-data"
        action="{{ route('chores.store') }}"
        class="mx-auto max-w-xs h-screen flex flex-col justify-center space-y-8"
    >
        @csrf
        <div>
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Add New Chore
            </h3>
        </div>

        <div class="mt-6">
            <div class="sm:col-span-2">
                <label for="title" class="block text-sm font-medium text-gray-700">
                    Title
                </label>
                <div class="mt-1 flex rounded-md shadow-sm">
                    <input type="text" name="title" id="title" class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-md sm:text-sm border-gray-300">
                </div>
            </div>
        </div>

        <div class="mt-6">
            <div class="sm:col-span-2">
                <label for="points" class="block text-sm font-medium text-gray-700">
                    Points
                </label>
                <div class="mt-1 flex rounded-md shadow-sm">
                    <input type="number" name="points" id="points" class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-md sm:text-sm border-gray-300">
                </div>
            </div>
        </div>

        <div class="mt-6">
            <label for="cover-photo" class="block text-sm font-medium text-gray-700">
                Photo
            </label>

            <span id="photo-name" class="hidden mt-1 mb-3 block text-sm font-medium text-gray-900"></span>

            <div id="photo-drop-area" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                <div class="space-y-1 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex text-sm text-gray-600">
                        <label for="photo" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                            <span>Upload a file</span>
                            <input id="photo" name="photo" type="file" class="sr-only">
                        </label>
                        <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs text-gray-500">
                        PNG or JPG
                    </p>
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <a
                href="{{ route('chores.index') }}"
                class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Cancel
            </a>
            <button
                type="submit"
                class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Add Chore
            </button>
        </div>
    </form>

    <x-slot name="scripts">
        <script>
            let dropArea = document.getElementById('photo-drop-area')
            let photoInput = document.getElementById('photo')
            let photoName = document.getElementById('photo-name')

            photoInput.onchange = handlePhotoChange

            function handlePhotoChange () {
                photoName.classList.remove('hidden')
                photoName.innerText = photoInput.files[0].name
            }

            ;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, preventDefaults, false)
            })

            function preventDefaults (e) {
                e.preventDefault()
                e.stopPropagation()
            }

            ;['dragenter', 'dragover'].forEach(eventName => {
                dropArea.addEventListener(eventName, highlight, false)
            })

            ;['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, unhighlight, false)
            })

            function highlight(e) {
                dropArea.classList.add('border-indigo-500')
            }

            function unhighlight(e) {
                dropArea.classList.remove('border-indigo-500')
            }

            dropArea.addEventListener('drop', handleDrop, false)

            function handleDrop(e) {
                photoInput.files = e.dataTransfer.files
                handlePhotoChange()
            }
        </script>
    </x-slot>
</x-layout>
