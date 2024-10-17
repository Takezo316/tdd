<x-app-layout>
    <div class="container">
        <div class="card">
            <h1 class="card-header">Create a Project</h1>
            <div class="card-body">
                <form class="" action="/projects" method="POST">
                    @csrf
                    <label class="form-label" for="title">Title</label>
                    <input class="form-control" type="text" name="title" id="title">
                    <label class="form-label" for="description">Description</label>
                    <textarea class="form-control" name="description" id="description"></textarea><br>
                    <button class="btn btn-primary" type="submit">
                        Create Project
                    </button>
                    <a class="btn btn-outline-danger" href="/projects">
                        Cancel
                    </a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

