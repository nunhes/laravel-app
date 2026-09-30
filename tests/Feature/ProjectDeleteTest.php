<?php

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('deletes an existing project', function () {
    $user = User::factory()->create();

    $project = Project::create([
        'name' => 'Proxecto para eliminar',
        'description' => 'Este proxecto será eliminado.',
    ]);

    $response = $this->actingAs($user)
        ->delete(route('projects.destroy', $project));

    $response->assertRedirect(route('projects.index'))
        ->assertSessionHas('success', 'Proxecto eliminado correctamente.');

    $this->assertDatabaseMissing('projects', [
        'id' => $project->id,
    ]);
});

it('returns not found when deleting a project that does not exist', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->delete('/projects/999999');

    $response->assertNotFound();
});
