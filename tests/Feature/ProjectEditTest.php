<?php

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('displays the project edit form with its current data', function () {
    $user = User::factory()->create();

    $project = Project::create([
        'name' => 'Proxecto orixinal',
        'description' => 'Descrición orixinal.',
    ]);

    $response = $this->actingAs($user)
        ->get(route('projects.edit', $project));

    $response->assertOk()
        ->assertSee('Editar proxecto')
        ->assertSee('Proxecto orixinal')
        ->assertSee('Descrición orixinal.')
        ->assertSee('Gardar cambios');
});

it('updates a project with valid data', function () {
    $user = User::factory()->create();

    $project = Project::create([
        'name' => 'Proxecto orixinal',
        'description' => 'Descrición orixinal.',
    ]);

    $response = $this->actingAs($user)
        ->put(route('projects.update', $project), [
            'name' => 'Proxecto actualizado',
            'description' => 'Descrición actualizada.',
        ]);

    $response->assertRedirect(route('projects.show', $project))
        ->assertSessionHas('success', 'Proxecto actualizado correctamente.');

    $this->assertDatabaseHas('projects', [
        'id' => $project->id,
        'name' => 'Proxecto actualizado',
        'description' => 'Descrición actualizada.',
    ]);
});

it('does not update a project without a name', function () {
    $user = User::factory()->create();

    $project = Project::create([
        'name' => 'Proxecto orixinal',
        'description' => 'Descrición orixinal.',
    ]);

    $response = $this->actingAs($user)
        ->put(route('projects.update', $project), [
            'name' => '',
            'description' => 'Descrición modificada.',
        ]);

    $response->assertSessionHasErrors('name');

    $this->assertDatabaseHas('projects', [
        'id' => $project->id,
        'name' => 'Proxecto orixinal',
        'description' => 'Descrición orixinal.',
    ]);
});

it('returns not found when editing a project that does not exist', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->get('/projects/999999/edit');

    $response->assertNotFound();
});
