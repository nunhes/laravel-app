<?php

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('displays a project and its tasks', function () {
    $project = Project::create([
        'name' => 'Proxecto de detalle',
        'description' => 'Descrición do proxecto.',
    ]);

    $project->tasks()->create([
        'title' => 'Primeira tarefa',
        'status' => 'pending',
        'priority' => 'high',
    ]);

    $project->tasks()->create([
        'title' => 'Segunda tarefa',
        'status' => 'in_progress',
        'priority' => 'medium',
    ]);

    $response = $this->get(route('projects.show', $project));

    $response->assertOk()
        ->assertSee('Proxecto de detalle')
        ->assertSee('Descrición do proxecto.')
        ->assertSee('Primeira tarefa')
        ->assertSee('Segunda tarefa')
        ->assertSee('pending')
        ->assertSee('in_progress');
});

it('returns not found for a missing project', function () {
    $response = $this->get('/projects/999999');

    $response->assertNotFound();
});
