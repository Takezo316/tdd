<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */

    public function test_guests_cannot_add_tasks(){
        $project = Project::factory()->create();

        $this->post($project->path().'/tasks')->assertRedirect('login');
    }

    public function test_only_owners_can_add_tasks(){

        $this->signIn();
        $project = Project::factory()->create();

        $this->post($project->path().'/tasks',['body'=>'A task'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'A task']);
    }

    public function test_only_owners_can_update_tasks(){

        $this->signIn();
        $project = Project::factory()->create();

        $task = $project->addTask('A task');

        $this->patch($project->path().'/tasks/'.$task->id, ['body'=>'changed'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'changed']);
    }

    public function test_project_can_have_tasks()
    {
        //$this->withoutExceptionHandling();
        $this->signIn();

        $project = Project::factory()->create(['user_id' => auth()->user()->id]);

        $this->post($project->path().'/tasks',['body'=>'A task']);

        $this->get($project->path())
            ->assertSee('A task');
    }

    public function test_a_task_can_be_updated(){
        $this->signIn();

        $project = Project::factory()->create(['user_id' => auth()->user()->id]);

        $task = $project->addTask('Test Task');

        $this->patch($project->path().'/tasks/'.$task->id,[
            'body'=>'changed',
            'completed' => true
        ]);

        $this->assertDatabaseHas('tasks',[
            'body'=>'changed',
            'completed' => true
        ]);
    }

    public function test_a_task_requires_body(){
        $this->signIn();

        $project = Project::factory()->create(['user_id' => auth()->user()->id]);

        $attributtes = Task::factory()->raw(['body' => '']);

        $this->post($project->path().'/tasks/',$attributtes)->assertSessionHasErrors('body');
    }
}
