<x-app-layout>
    <style>
        ul li{
            list-style-type: circle;
        }
    </style>
    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div>
                <a style="float:right" class="inline-flex items-center px-4  bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" href="/projects/create">
                    Create new project
                </a>
                <h3 class="text-lg font-medium font-weight-bold">Projects List</h3>
                <div class="flex items-center mb-3">
                    @forelse ($projects as $project)
                        <div class="bg-white mr-2 p-4 shadow-xl rounded-lg" style="width: 33%; height: 200px;">
                            <h3 class="font-semibold text-xl mb-6"><a href="{{ $project->path() }}">{{ $project->title }}</a></h3>
                            <div class="text-gray-400">{{ Str::limit($project->description)  }}</div>
                        </div>
                    @empty
                        <div>No projects Yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
