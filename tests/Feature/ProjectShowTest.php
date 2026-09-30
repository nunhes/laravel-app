<?php

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('displays an existing project without tasks', function () {
    $project = Project::create([
        'name' => 'Proxecto de exemplo',
        'description' => 'Descrición do proxecto.',
    ]);

    $response = $this->get(route('projects.show', $project));

    $response->assertOk()
        ->assertSee('Proxecto de exemplo')
        ->assertSee('Descrición do proxecto.')
        ->assertSee('Tarefas')
        ->assertSee('Este proxecto aínda non ten tarefas.')
        ->assertSee('Crear tarefa');
});

it('displays an existing project with its tasks', function () {
    $project = Project::create([
        'name' => 'Proxecto con tarefas',
        'description' => 'Proxecto para probar as tarefas.',
    ]);

    $project->tasks()->create([
        'title' => 'Primeira tarefa',
    ]);

    $project->tasks()->create([
        'title' => 'Segunda tarefa',
    ]);

    $response = $this->get(route('projects.show', $project));

    $response->assertOk()
        ->assertSee('Proxecto con tarefas')
        ->assertSee('Proxecto para probar as tarefas.')
        ->assertSee('Primeira tarefa')
        ->assertSee('Segunda tarefa')
        ->assertSee('Tarefas');
});

it('returns not found for a project that does not exist', function () {
    $response = $this->get('/projects/999999');

    $response->assertNotFound();
});
