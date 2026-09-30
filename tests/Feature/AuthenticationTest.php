<?php

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows the login form to guests', function () {
    $response = $this->get('/login');

    $response->assertOk()
        ->assertSee('Iniciar sesión')
        ->assertSee('Correo electrónico')
        ->assertSee('Contrasinal');
});

it('redirects guests from protected project routes to login', function () {
    $project = Project::create([
        'name' => 'Proxecto protexido',
    ]);

    $response = $this->get(route('projects.create'));

    $response->assertRedirect('/login');

    $response = $this->get(route('projects.edit', $project));

    $response->assertRedirect('/login');
});

it('redirects guests from protected task routes to login', function () {
    $project = Project::create([
        'name' => 'Proxecto protexido',
    ]);

    $task = $project->tasks()->create([
        'title' => 'Tarefa protexida',
    ]);

    $response = $this->get(
        route('projects.tasks.create', $project)
    );

    $response->assertRedirect('/login');

    $response = $this->get(
        route('projects.tasks.edit', [$project, $task])
    );

    $response->assertRedirect('/login');
});

it('allows an authenticated user to access protected routes', function () {
    $user = User::factory()->create();

    $project = Project::create([
        'name' => 'Proxecto protexido',
    ]);

    $task = $project->tasks()->create([
        'title' => 'Tarefa protexida',
    ]);

    $this->actingAs($user)
        ->get(route('projects.create'))
        ->assertOk();

    $this->actingAs($user)
        ->get(route('projects.edit', $project))
        ->assertOk();

    $this->actingAs($user)
        ->get(route('projects.tasks.create', $project))
        ->assertOk();

    $this->actingAs($user)
        ->get(route('projects.tasks.edit', [$project, $task]))
        ->assertOk();
});

it('allows an authenticated user to log out', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('logout'))
        ->assertRedirect(route('home'));

    $this->assertGuest();
});
