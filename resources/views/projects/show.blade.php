@extends('layouts.app')

@section('title', $project->name)

@section('content')
    <p>
        <a href="{{ route('projects.index') }}">← Volver aos proxectos</a>
    </p>

    <h1>{{ $project->name }}</h1>

    @if ($project->description)
        <p>{{ $project->description }}</p>
    @endif

    <p>
        <a href="{{ route('projects.edit', $project) }}">
            Editar proxecto
        </a>
    </p>

    <form method="POST" action="{{ route('projects.destroy', $project) }}">
        @csrf
        @method('DELETE')

        <button type="submit">Eliminar proxecto</button>
    </form>

    <h2>Tarefas</h2>

    <p>
        <a href="{{ route('projects.tasks.create', $project) }}">
            Crear tarefa
        </a>
    </p>

    @if ($project->tasks->isEmpty())
        <p>Este proxecto aínda non ten tarefas.</p>
    @else
        <ul>
            @foreach ($project->tasks as $task)
                <li>
                    <strong>{{ $task->title }}</strong>
                    — {{ $task->status }}
                    — prioridade {{ $task->priority }}
                </li>
            @endforeach
        </ul>

        <p>
            <a href="{{ route('projects.tasks.index', $project) }}">
                Ver todas as tarefas
            </a>
        </p>
    @endif
@endsection
