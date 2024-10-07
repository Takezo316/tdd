<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_project_can_have_tasks()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $project = Project::factory()->create(['user_id' => auth()->user()->id]);

        $this->post($project->path().'/tasks',['body'=>'A task']);

        $this->get($project->path())
            ->assertSee('A task');
    }
}
