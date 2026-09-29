<!DOCTYPE html>
<html lang="gl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar {{ $project->name }}</title>
</head>
<body>
    <p>
        <a href="{{ route('projects.show', $project) }}">← Volver ao proxecto</a>
    </p>

    <h1>Editar proxecto</h1>

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

    <form method="POST" action="{{ route('projects.update', $project) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Nome</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $project->name) }}"
                required
            >
        </div>

        <div>
            <label for="description">Descrición</label>
            <textarea
                id="description"
                name="description"
                rows="5"
            >{{ old('description', $project->description) }}</textarea>
        </div>

        <button type="submit">Gardar cambios</button>
    </form>
</body>
</html>
