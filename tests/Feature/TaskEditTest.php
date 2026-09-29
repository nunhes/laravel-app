<?php

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('displays the edit form for a task', function () {
    $project = Project::create([
        'name' => 'Proxecto das tarefas',
    ]);

    $task = $project->tasks()->create([
        'title' => 'Tarefa inicial',
        'description' => 'Descrición inicial.',
        'status' => 'pending',
        'priority' => 'medium',
        'due_date' => '2026-10-10',
    ]);

    $response = $this->get(
        route('projects.tasks.edit', [$project, $task])
    );

    $response->assertOk()
        ->assertSee('Editar tarefa')
        ->assertSee('Tarefa inicial')
        ->assertSee('Descrición inicial.')
        ->assertSee('Gardar cambios');
});

it('updates a task', function () {
    $project = Project::create([
        'name' => 'Proxecto de actualización',
    ]);

    $task = $project->tasks()->create([
        'title' => 'Título inicial',
        'description' => 'Descrición inicial.',
        'status' => 'pending',
        'priority' => 'low',
        'due_date' => '2026-10-10',
    ]);

    $response = $this->put(
        route('projects.tasks.update', [$project, $task]),
        [
            'title' => 'Título actualizado',
            'description' => 'Descrición actualizada.',
            'status' => 'completed',
            'priority' => 'high',
            'due_date' => '2026-11-15',
        ]
    );

    $task->refresh();

    expect($task->title)->toBe('Título actualizado')
        ->and($task->description)->toBe('Descrición actualizada.')
        ->and($task->status)->toBe('completed')
        ->and($task->priority)->toBe('high')
        ->and($task->due_date->format('Y-m-d'))->toBe('2026-11-15');

    $response->assertRedirect(
        route('projects.tasks.index', $project)
    );
});

it('validates task fields when updating', function () {
    $project = Project::create([
        'name' => 'Proxecto de validación',
    ]);

    $task = $project->tasks()->create([
        'title' => 'Tarefa existente',
        'description' => 'Descrición existente.',
        'status' => 'pending',
        'priority' => 'medium',
        'due_date' => '2026-10-10',
    ]);

    $response = $this->put(
        route('projects.tasks.update', [$project, $task]),
        [
            'title' => '',
            'status' => 'invalid',
            'priority' => 'invalid',
            'due_date' => 'non-date',
        ]
    );

    $response->assertSessionHasErrors([
        'title',
        'status',
        'priority',
        'due_date',
    ]);

    $task->refresh();

    expect($task->title)->toBe('Tarefa existente')
        ->and($task->status)->toBe('pending')
        ->and($task->priority)->toBe('medium')
        ->and($task->due_date->format('Y-m-d'))->toBe('2026-10-10');
});
