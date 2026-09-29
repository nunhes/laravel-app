@extends('layouts.app')

@section('title', 'Editar ' . $project->name)

@section('content')
    <p>
        <a href="{{ route('projects.show', $project) }}">
            ← Volver ao proxecto
        </a>
    </p>

    <h1>Editar proxecto</h1>

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
@endsection
