
<x-app-layout>
    <div class="container">
        <div class="d-grid justify-content-end">
            <a class="btn btn-primary btn-sm" href="/projects/create">
                Create New Project
            </a>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <h2 class="card-header">Tasks</h2>
                    <div class="list-group list-group-flush">
                        @foreach ($project->tasks as $task)
                            <div class="list-group-item">
                                <form method="POST" action="{{ $task->path() }}">
                                    @method('PATCH')
                                    @csrf
                                    <div class="input-group">
                                        <input class="form-control {{ $task->completed ? 'text-primary':'' }}" name="body" type="text" value="{{ $task->body }}">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox" name="completed" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                        <div class="card-body">
                            <form action="{{ $project->path().'/tasks' }}" method="POST">
                                @csrf
                                <input class="form-control" type="text" placeholder="Add a new task" name="body">
                            </form>

                        </div>
                    </div>

                </div>
                <br>
                <div class="card">
                    <h2 class="card-header">General Notes</h2>
                    <form action="{{ $project->path() }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="card-body">
                            <textarea class="form-control" name="notes" rows="5" placeholder="Add some notes...">{{ $project->notes }}</textarea>
                            <br>
                            <button class="btn btn-primary" type="submit">Save Notes</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div>
                        <h2 class="card-header">{{ $project->title }}</h2>
                    </div>

                    <div class="card-body">
                        {{ $project->description }}
                    </div>
                </div>
                <br>
                <a class="btn btn-outline-dark d-grid" href="/projects">
                    Go Back
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
