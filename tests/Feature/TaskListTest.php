<?php

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('lists the tasks belonging to a project', function () {
    $project = Project::create([
        'name' => 'Proxecto con tarefas',
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

    $response = $this->get(
        route('projects.tasks.index', $project)
    );

    $response->assertOk()
        ->assertSee('Tarefas de Proxecto con tarefas')
        ->assertSee('Primeira tarefa')
        ->assertSee('Segunda tarefa')
        ->assertSee('pending')
        ->assertSee('in_progress');
});

it('does not list tasks belonging to another project', function () {
    $project = Project::create([
        'name' => 'Proxecto correcto',
    ]);

    $otherProject = Project::create([
        'name' => 'Outro proxecto',
    ]);

    $project->tasks()->create([
        'title' => 'Tarefa do proxecto correcto',
    ]);

    $otherProject->tasks()->create([
        'title' => 'Tarefa doutro proxecto',
    ]);

    $response = $this->get(
        route('projects.tasks.index', $project)
    );

    $response->assertOk()
        ->assertSee('Tarefa do proxecto correcto')
        ->assertDontSee('Tarefa doutro proxecto');
});
