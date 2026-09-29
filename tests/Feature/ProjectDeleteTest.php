<?php

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('deletes a project and its tasks', function () {
    $project = Project::create([
        'name' => 'Proxecto para eliminar',
        'description' => 'Este proxecto será eliminado.',
    ]);

    $task = $project->tasks()->create([
        'title' => 'Tarefa que tamén debe eliminarse',
    ]);

    $response = $this->delete(
        route('projects.destroy', $project)
    );

    expect(Project::find($project->id))->toBeNull()
        ->and(Task::find($task->id))->toBeNull();

    $response->assertRedirect(route('projects.index'));
});

it('returns not found when deleting a missing project', function () {
    $response = $this->delete('/projects/999999');

    $response->assertNotFound();
});
