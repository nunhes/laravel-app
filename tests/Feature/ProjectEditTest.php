<?php

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('displays the edit form for a project', function () {
    $project = Project::create([
        'name' => 'Proxecto para editar',
        'description' => 'Descrición inicial.',
    ]);

    $response = $this->get(route('projects.edit', $project));

    $response->assertOk()
        ->assertSee('Editar proxecto')
        ->assertSee('Proxecto para editar')
        ->assertSee('Descrición inicial.')
        ->assertSee('Gardar cambios');
});

it('returns not found when editing a missing project', function () {
    $response = $this->get('/projects/999999/edit');

    $response->assertNotFound();
});

it('updates a project', function () {
    $project = Project::create([
        'name' => 'Nome inicial',
        'description' => 'Descrición inicial.',
    ]);

    $response = $this->put(
        route('projects.update', $project),
        [
            'name' => 'Nome actualizado',
            'description' => 'Descrición actualizada.',
        ]
    );

    $project->refresh();

    expect($project->name)->toBe('Nome actualizado')
        ->and($project->description)->toBe('Descrición actualizada.');

    $response->assertRedirect(route('projects.show', $project));
});

it('requires a project name when updating', function () {
    $project = Project::create([
        'name' => 'Proxecto existente',
        'description' => 'Descrición existente.',
    ]);

    $response = $this->put(
        route('projects.update', $project),
        [
            'name' => '',
            'description' => 'Nova descrición.',
        ]
    );

    $response->assertSessionHasErrors('name');

    $project->refresh();

    expect($project->name)->toBe('Proxecto existente')
        ->and($project->description)->toBe('Descrición existente.');
});
