<!DOCTYPE html>
<html lang="gl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $project->name }}</title>
</head>
<body>
    <p>
        <a href="{{ route('projects.index') }}">← Volver aos proxectos</a>
    </p>

    <h1>{{ $project->name }}</h1>

    @if ($project->description)
        <p>{{ $project->description }}</p>
    @endif

    <h2>Tarefas</h2>

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
    @endif
</body>
</html>
