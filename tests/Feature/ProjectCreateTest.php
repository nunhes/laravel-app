<?php

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('creates a project', function () {
    $response = $this->post(route('projects.store'), [
        'name' => 'Novo proxecto',
        'description' => 'Descrición do proxecto.',
    ]);

    $project = Project::where('name', 'Novo proxecto')->first();

    expect($project)->not->toBeNull()
        ->and($project->description)->toBe('Descrición do proxecto.');

    $response->assertRedirect(route('projects.show', $project));
});

it('requires a project name', function () {
    $response = $this->post(route('projects.store'), [
        'name' => '',
        'description' => 'Proxecto sen nome.',
    ]);

    $response->assertSessionHasErrors('name');

    expect(Project::where('description', 'Proxecto sen nome.')->exists())
        ->toBeFalse();
});
