<?php

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('lists the tasks belonging to a project', function () {
    $project = Project::create([
        'name' => 'Proxecto con tarefas',
    ]);

    $project->tasks()->create([
        'title' => 'Primeira tarefa',
        'status' => 'pending',
        'priority' => 'high',
        'due_date' => '2026-10-05',
    ]);

    $project->tasks()->create([
        'title' => 'Segunda tarefa',
        'status' => 'in_progress',
        'priority' => 'medium',
        'due_date' => '2026-10-10',
    ]);

    $response = $this->get(
        route('projects.tasks.index', $project)
    );

    $response->assertOk()
        ->assertSee('Tarefas de Proxecto con tarefas')
        ->assertSee('Primeira tarefa')
        ->assertSee('Segunda tarefa')
        ->assertSee('Pendente')
        ->assertSee('En progreso')
        ->assertSee('Alta')
        ->assertSee('Media')
        ->assertSee('05/10/2026')
        ->assertSee('10/10/2026');
});

it('does not list tasks belonging to another project', function () {
    $project = Project::create([
        'name' => 'Proxecto correcto',
    ]);

    $otherProject = Project::create([
        'name' => 'Outro proxecto',
    ]);

    $project->tasks()->create([
        'title' => 'Tarefa do proxecto correcto',
    ]);

    $otherProject->tasks()->create([
        'title' => 'Tarefa doutro proxecto',
    ]);

    $response = $this->get(
        route('projects.tasks.index', $project)
    );

    $response->assertOk()
        ->assertSee('Tarefa do proxecto correcto')
        ->assertDontSee('Tarefa doutro proxecto');
});

it('filters tasks by status', function () {
    $project = Project::create([
        'name' => 'Proxecto con filtros',
    ]);

    $project->tasks()->create([
        'title' => 'Tarefa pendente',
        'status' => 'pending',
        'priority' => 'high',
    ]);

    $project->tasks()->create([
        'title' => 'Tarefa en progreso',
        'status' => 'in_progress',
        'priority' => 'medium',
    ]);

    $response = $this->get(
        route('projects.tasks.index', [
            'project' => $project,
            'status' => 'pending',
        ])
    );

    $response->assertOk()
        ->assertSee('Tarefa pendente')
        ->assertDontSee('Tarefa en progreso');
});

it('filters tasks by priority', function () {
    $project = Project::create([
        'name' => 'Proxecto con filtros',
    ]);

    $project->tasks()->create([
        'title' => 'Tarefa de alta prioridade',
        'status' => 'pending',
        'priority' => 'high',
    ]);

    $project->tasks()->create([
        'title' => 'Tarefa de baixa prioridade',
        'status' => 'pending',
        'priority' => 'low',
    ]);

    $response = $this->get(
        route('projects.tasks.index', [
            'project' => $project,
            'priority' => 'high',
        ])
    );

    $response->assertOk()
        ->assertSee('Tarefa de alta prioridade')
        ->assertDontSee('Tarefa de baixa prioridade');
});

it('filters tasks by status and priority', function () {
    $project = Project::create([
        'name' => 'Proxecto con filtros combinados',
    ]);

    $project->tasks()->create([
        'title' => 'Pendente e alta',
        'status' => 'pending',
        'priority' => 'high',
    ]);

    $project->tasks()->create([
        'title' => 'Pendente e media',
        'status' => 'pending',
        'priority' => 'medium',
    ]);

    $project->tasks()->create([
        'title' => 'En progreso e alta',
        'status' => 'in_progress',
        'priority' => 'high',
    ]);

    $response = $this->get(
        route('projects.tasks.index', [
            'project' => $project,
            'status' => 'pending',
            'priority' => 'high',
        ])
    );

    $response->assertOk()
        ->assertSee('Pendente e alta')
        ->assertDontSee('Pendente e media')
        ->assertDontSee('En progreso e alta');
});

it('rejects an invalid status filter', function () {
    $project = Project::create([
        'name' => 'Proxecto con filtro inválido',
    ]);

    $this->get(
        route('projects.tasks.index', [
            'project' => $project,
            'status' => 'invalid',
        ])
    )
        ->assertRedirect()
        ->assertSessionHasErrors('status');
});

it('rejects an invalid priority filter', function () {
    $project = Project::create([
        'name' => 'Proxecto con filtro inválido',
    ]);

    $this->get(
        route('projects.tasks.index', [
            'project' => $project,
            'priority' => 'invalid',
        ])
    )
        ->assertRedirect()
        ->assertSessionHasErrors('priority');
});
