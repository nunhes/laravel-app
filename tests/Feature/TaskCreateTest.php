<?php

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('creates a task for a project', function () {
    $user = User::factory()->create();

    $project = Project::create([
        'name' => 'Proxecto de tarefas',
    ]);

    $response = $this->actingAs($user)->post(
        route('projects.tasks.store', $project),
        [
            'title' => 'Implementar formulario',
            'description' => 'Crear o formulario de tarefas.',
            'status' => 'in_progress',
            'priority' => 'high',
            'due_date' => '2026-10-10',
        ]
    );

    $task = Task::where('title', 'Implementar formulario')->first();

    expect($task)->not->toBeNull()
        ->and($task->project_id)->toBe($project->id)
        ->and($task->description)->toBe('Crear o formulario de tarefas.')
        ->and($task->status)->toBe('in_progress')
        ->and($task->priority)->toBe('high')
        ->and($task->due_date->format('Y-m-d'))->toBe('2026-10-10');

    $response->assertRedirect(
        route('projects.tasks.index', $project)
    );
});

it('validates task fields', function () {
    $user = User::factory()->create();

    $project = Project::create([
        'name' => 'Proxecto de validación',
    ]);

    $response = $this->actingAs($user)->post(
        route('projects.tasks.store', $project),
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

    expect(Task::count())->toBe(0);
});
