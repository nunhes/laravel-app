<?php

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

uses(RefreshDatabase::class);

it('uses the PostgreSQL testing database', function () {
    expect(DB::connection()->getDriverName())->toBe('pgsql')
        ->and(DB::connection()->getDatabaseName())->toBe('laravel_testing');
});

it('creates and retrieves a project', function () {
    $project = Project::create([
        'name' => 'Proxecto de proba',
        'description' => 'Proba real contra PostgreSQL.',
    ]);

    expect($project->exists)->toBeTrue()
        ->and($project->name)->toBe('Proxecto de proba')
        ->and($project->description)->toBe('Proba real contra PostgreSQL.')
        ->and(Project::find($project->id))->not->toBeNull();
});
