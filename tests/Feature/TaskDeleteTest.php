<?php

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('deletes a task from a project', function () {
    $project = Project::create([
        'name' => 'Proxecto de eliminación',
    ]);

    $task = $project->tasks()->create([
        'title' => 'Tarefa para eliminar',
    ]);

    $response = $this->delete(
        route('projects.tasks.destroy', [$project, $task])
    );

    expect(Task::find($task->id))->toBeNull()
        ->and(Project::find($project->id))->not->toBeNull();

    $response->assertRedirect(
        route('projects.tasks.index', $project)
    );
});

it('cannot delete a task belonging to another project', function () {
    $project = Project::create([
        'name' => 'Proxecto correcto',
    ]);

    $otherProject = Project::create([
        'name' => 'Outro proxecto',
    ]);

    $task = $otherProject->tasks()->create([
        'title' => 'Tarefa doutro proxecto',
    ]);

    $response = $this->delete(
        route('projects.tasks.destroy', [$project, $task])
    );

    $response->assertNotFound();

    expect(Task::find($task->id))->not->toBeNull();
});
