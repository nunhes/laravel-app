@extends('layouts.app')

@section('title', 'Tarefas de ' . $project->name)

@section('content')
    <p>
        <a href="{{ route('projects.show', $project) }}">
            ← Volver ao proxecto
        </a>
    </p>

    <h1>Tarefas de {{ $project->name }}</h1>

    <p>
        <a href="{{ route('projects.tasks.create', $project) }}">
            Crear tarefa
        </a>
    </p>

    @if ($tasks->isEmpty())
        <p>Este proxecto aínda non ten tarefas.</p>
    @else
        <ul>
            @foreach ($tasks as $task)
                <li>
                    <strong>{{ $task->title }}</strong>
                    — {{ $task->status }}
                    — prioridade {{ $task->priority }}

                    <div>
                        <a href="{{ route('projects.tasks.edit', [$project, $task]) }}">
                            Editar
                        </a>

                        <form
                            method="POST"
                            action="{{ route('projects.tasks.destroy', [$project, $task]) }}"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit">Eliminar</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
