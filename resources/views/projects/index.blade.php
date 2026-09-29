<!DOCTYPE html>
<html lang="gl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proxectos</title>
</head>
<body>
    <h1>Proxectos</h1>

    @if ($projects->isEmpty())
        <p>Aínda non hai proxectos.</p>
    @else
        <ul>
            @foreach ($projects as $project)
                <li>
                    <strong>{{ $project->name }}</strong>
                    — {{ $project->tasks_count }} tarefas

                    @if ($project->description)
                        <p>{{ $project->description }}</p>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>
