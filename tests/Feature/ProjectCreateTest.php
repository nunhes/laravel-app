<?php

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('displays the project creation form', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->get('/projects/create');

    $response->assertOk()
        ->assertSee('Crear proxecto');
});

it('creates a project with valid data', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->post('/projects', [
            'name' => 'Novo proxecto',
            'description' => 'Descrición do novo proxecto.',
        ]);

    $project = Project::where('name', 'Novo proxecto')->first();

    $response->assertRedirect(route('projects.show', $project))
        ->assertSessionHas('success', 'Proxecto creado correctamente.');

    $this->assertDatabaseHas('projects', [
        'name' => 'Novo proxecto',
        'description' => 'Descrición do novo proxecto.',
    ]);
});

it('does not create a project without a name', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->post('/projects', [
            'name' => '',
            'description' => 'Descrición sen nome.',
        ]);

    $response->assertSessionHasErrors('name');

    $this->assertDatabaseMissing('projects', [
        'description' => 'Descrición sen nome.',
    ]);
});
