@extends('layouts.app')

@section('title', 'Nova tarefa — ' . $project->name)

@section('content')
    <p>
        <a href="{{ route('projects.tasks.index', $project) }}" class="px-6 py-2 text-xs font-medium leading-6 text-center text-white uppercase transition bg-blue-700 rounded-full shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none">
            ← Volver ás tarefas
        </a>
    </p>

    <h1>Nova tarefa</h1>

    <p>
        Proxecto: <strong>{{ $project->name }}</strong>
    </p>

    <form method="POST" action="{{ route('projects.tasks.store', $project) }}">
        @csrf

        <div>
            <label for="title">Título</label>
            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title') }}"
                required
                class="border border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
            >
        </div>

        <div>
            <label for="description">Descrición</label>
            <textarea
                id="description"
                name="description"
                rows="5"
                class="border border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
            >{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="status">Estado</label>
            <select id="status" name="status">
                <option value="pending" @selected(old('status', 'pending') === 'pending')>
                    Pendente
                </option>
                <option value="in_progress" @selected(old('status') === 'in_progress')>
                    En progreso
                </option>
                <option value="completed" @selected(old('status') === 'completed')>
                    Completada
                </option>
            </select>
        </div>

        <div>
            <label for="priority">Prioridade</label>
            <select id="priority" name="priority">
                <option value="low" @selected(old('priority') === 'low')>
                    Baixa
                </option>
                <option value="medium" @selected(old('priority', 'medium') === 'medium')>
                    Media
                </option>
                <option value="high" @selected(old('priority') === 'high')>
                    Alta
                </option>
            </select>
        </div>

        <div>
            <label for="due_date">Data límite</label>
            <input
                type="date"
                id="due_date"
                name="due_date"
                value="{{ old('due_date') }}"
                class="border border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
            >
        </div>

        <button class="bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50" type="submit">Crear tarefa</button>
    </form>
@endsection
