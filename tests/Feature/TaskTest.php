<?php

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('creates a task associated with a project', function () {
    $project = Project::create([
        'name' => 'Proxecto Laravel',
        'description' => 'Proxecto de desenvolvemento.',
    ]);

    $task = Task::create([
        'project_id' => $project->id,
        'title' => 'Crear primeiro CRUD',
        'description' => 'Implementar a xestión básica de tarefas.',
        'status' => 'pending',
        'priority' => 'high',
        'due_date' => '2026-10-05',
    ]);

    expect($task->project->is($project))->toBeTrue()
        ->and($project->tasks)->toHaveCount(1)
        ->and($project->tasks->first()->is($task))->toBeTrue()
        ->and($task->status)->toBe('pending')
        ->and($task->priority)->toBe('high')
        ->and($task->due_date->format('Y-m-d'))->toBe('2026-10-05');
});

it('deletes a project and its tasks', function () {
    $project = Project::create([
        'name' => 'Proxecto para borrar',
    ]);

    $task = Task::create([
        'project_id' => $project->id,
        'title' => 'Tarefa asociada',
    ]);

    $project->delete();

    expect(Task::find($task->id))->toBeNull();
});
