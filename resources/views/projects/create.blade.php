<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h1 class="text-lg font-medium font-weight-bold">Create a Project</h1>
                    <form class="mb-3" action="/projects" method="POST">
                        @csrf
                        <label class="block font-medium text-sm text-gray-700" for="title">Title</label>
                        <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" type="text" name="title" id="title">
                        <label class="block font-medium text-sm text-gray-700" for="description">Description</label>
                        <textarea class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" name="description" id="description"></textarea><br>
                        <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" type="submit">
                            Create Project
                        </button>
                        <a class="inline-flex items-center px-4 py-2 bg-warning border rounded-md active:bg-danger hover:bg-danger " href="/projects">
                            Cancel
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

