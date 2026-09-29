<?php

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('displays the projects page', function () {
    $response = $this->get('/projects');

    $response->assertOk()
        ->assertSee('Proxectos')
        ->assertSee('Aínda non hai proxectos.');
});

it('displays existing projects with their task count', function () {
    $project = Project::create([
        'name' => 'Proxecto de exemplo',
        'description' => 'Un proxecto para probar o listado.',
    ]);

    $project->tasks()->create([
        'title' => 'Primeira tarefa',
    ]);

    $project->tasks()->create([
        'title' => 'Segunda tarefa',
    ]);

    $response = $this->get('/projects');

    $response->assertOk()
        ->assertSee('Proxecto de exemplo')
        ->assertSee('2 tarefas')
        ->assertSee('Un proxecto para probar o listado.');
});
