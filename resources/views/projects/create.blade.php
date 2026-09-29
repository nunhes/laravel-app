<!DOCTYPE html>
<html lang="gl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear proxecto</title>
</head>
<body>
    <h1>Crear proxecto</h1>

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

    <form method="POST" action="{{ route('projects.store') }}">
        @csrf

        <div>
            <label for="name">Nome</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
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

        <button type="submit">Crear proxecto</button>
    </form>

    <p>
        <a href="{{ route('projects.index') }}">Volver aos proxectos</a>
    </p>
</body>
</html>
