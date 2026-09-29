<!DOCTYPE html>
<html lang="gl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova tarefa — {{ $project->name }}</title>
</head>
<body>
    <p>
        <a href="{{ route('projects.tasks.index', $project) }}">
            ← Volver ás tarefas
        </a>
    </p>

    <h1>Nova tarefa</h1>

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
            >
        </div>

        <div>
            <label for="description">Descrición</label>
            <textarea
                id="description"
                name="description"
                rows="5"
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
            >
        </div>

        <button type="submit">Crear tarefa</button>
    </form>
</body>
</html>
