<!DOCTYPE html>
<html lang="gl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarefas de {{ $project->name }}</title>
</head>
<body>
    <p>
        <a href="{{ route('projects.show', $project) }}">← Volver ao proxecto</a>
    </p>

    <h1>Tarefas de {{ $project->name }}</h1>

    @if ($tasks->isEmpty())
        <p>Este proxecto aínda non ten tarefas.</p>
    @else
        <ul>
            @foreach ($tasks as $task)
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
