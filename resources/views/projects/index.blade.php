<x-app-layout>
    <div class="container-fluid">
        <div>
            <div>
                <a class="btn btn-primary float-end" href="/projects/create">
                    Create New Project
                </a>
                <h1 class="">Projects List</h1>
                <div class=" row">
                    @forelse ($projects as $project)
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <h3><a class="no-underline" href="{{ $project->path() }}">{{ $project->title }}</a></h3>
                                </div>
                                <div class="card-body"><div class="card-text">{{ Str::limit($project->description)  }}</div></div>
                            </div>
                        </div>
                    @empty
                        <div>No projects Yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
