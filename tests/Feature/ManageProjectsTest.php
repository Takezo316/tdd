<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $this->get('/projects/create')->assertStatus(200);

        $attributtes = [
            'title' => $this->faker()->sentence(),
            'description' => $this->faker()->paragraph()
        ];

        $this->post('/projects', $attributtes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributtes);

        $this->get('/projects')->assertSee($attributtes['title']);
    }

    public function test_a_user_can_view_a_project(){

        $this->signIn();
        $this->withoutExceptionHandling();
        $project = Project::factory()->create(['user_id' => auth()->user()->id]);


        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    public function test_a_user_cannot_view_others_projects(){

        $this->signIn();
        //$this->withoutExceptionHandling();
        $project = Project::factory()->create();


        $this->get($project->path())
            ->assertStatus(403);
    }

    public function test_a_project_requires_a_title(){

        $this->signIn();

        $attributtes = Project::factory()->raw(['title' => '']);

        $this->post('/projects',$attributtes)->assertSessionHasErrors('title');
    }

    public function test_a_project_requires_a_description(){

        $this->signIn();

        $attributtes = Project::factory()->raw(['description' => '']);

        $this->post('/projects',$attributtes)->assertSessionHasErrors('description');
    }

    public function test_guests_cannot_manage_projects(){

        $project = Project::factory()->create();

        $this->get('/projects')->assertRedirect('/login');
        $this->get('/projects/create')->assertRedirect('/login');
        $this->get($project->path())->assertRedirect('/login');
        $this->post('/projects',$project->toArray())->assertRedirect('/login');
    }

    public function test_guests_cannot_create_projects(){

        //$this->withoutExceptionHandling();

        $attributtes = Project::factory()->raw();

        $this->post('/projects',$attributtes)->assertRedirect('/login');
    }

    public function test_guests_cannot_view_projects(){

        $this->get('/projects')->assertRedirect('/login');
    }

    public function test_guests_cannot_view_any_project(){

        $project = Project::factory()->create();

        $this->get($project->path())->assertRedirect('/login');
    }
}
