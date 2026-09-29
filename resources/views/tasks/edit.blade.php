<!DOCTYPE html>
<html lang="gl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar tarefa — {{ $project->name }}</title>
</head>
<body>
    <p>
        <a href="{{ route('projects.tasks.index', $project) }}">
            ← Volver ás tarefas
        </a>
    </p>

    <h1>Editar tarefa</h1>

    <p>Proxecto: <strong>{{ $project->name }}</strong></p>

    @if ($errors->any())
        <div>
            <strong>Hai erros no formulario:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('projects.tasks.update', [$project, $task]) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="title">Título</label>
            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title', $task->title) }}"
                required
            >
        </div>

        <div>
            <label for="description">Descrición</label>
            <textarea
                id="description"
                name="description"
                rows="5"
            >{{ old('description', $task->description) }}</textarea>
        </div>

        <div>
            <label for="status">Estado</label>
            <select id="status" name="status">
                <option value="pending" @selected(old('status', $task->status) === 'pending')>
                    Pendente
                </option>
                <option value="in_progress" @selected(old('status', $task->status) === 'in_progress')>
                    En progreso
                </option>
                <option value="completed" @selected(old('status', $task->status) === 'completed')>
                    Completada
                </option>
            </select>
        </div>

        <div>
            <label for="priority">Prioridade</label>
            <select id="priority" name="priority">
                <option value="low" @selected(old('priority', $task->priority) === 'low')>
                    Baixa
                </option>
                <option value="medium" @selected(old('priority', $task->priority) === 'medium')>
                    Media
                </option>
                <option value="high" @selected(old('priority', $task->priority) === 'high')>
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
                value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}"
            >
        </div>

        <button type="submit">Gardar cambios</button>
    </form>
</body>
</html>
