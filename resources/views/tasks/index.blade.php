@extends('layouts.app')

@section('title', 'Tarefas de ' . $project->name)

@section('content')
    <p>
        <a href="{{ route('projects.show', $project) }}" class="px-6 py-2 text-xs font-medium leading-6 text-center text-white uppercase transition bg-blue-700 rounded-full shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none">
            ← Volver ao proxecto
        </a>
    </p>

    <h1>Tarefas de {{ $project->name }}</h1>

<form method="GET" action="{{ route('projects.tasks.index', $project) }}">
    <div>
        <label for="status">Estado</label>

        <select name="status" id="status">
            <option value="">Todos</option>
            <option value="pending" @selected(request('status') === 'pending')>
                Pendentes
            </option>
            <option value="in_progress" @selected(request('status') === 'in_progress')>
                En progreso
            </option>
            <option value="completed" @selected(request('status') === 'completed')>
                Completadas
            </option>
        </select>
    </div>

    <div>
        <label for="priority">Prioridade</label>

        <select name="priority" id="priority">
            <option value="">Todas</option>
            <option value="low" @selected(request('priority') === 'low')>
                Baixa
            </option>
            <option value="medium" @selected(request('priority') === 'medium')>
                Media
            </option>
            <option value="high" @selected(request('priority') === 'high')>
                Alta
            </option>
        </select>
    </div>

    <button type="submit">Filtrar</button>

    @if (request()->hasAny(['status', 'priority']))
        <a href="{{ route('projects.tasks.index', $project) }}">
            Limpar filtros
        </a>
    @endif
</form>

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
                    — {{ [
                        'pending' => 'Pendente',
                        'in_progress' => 'En progreso',
                        'completed' => 'Completada',
                    ][$task->status] }}

                    — prioridade {{ [
                        'low' => 'Baixa',
                        'medium' => 'Media',
                        'high' => 'Alta',
                    ][$task->priority] }}

                    @if ($task->due_date)
                        — data límite {{ $task->due_date->format('d/m/Y') }}
                    @endif

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

                            <button class="bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50" type="submit">Eliminar</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
