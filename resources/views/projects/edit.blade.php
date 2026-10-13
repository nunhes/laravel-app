@extends('layouts.app')

@section('title', 'Editar ' . $project->name)

@section('content')
    <p>
        <a href="{{ route('projects.show', $project) }}" class="px-6 py-2 text-xs font-medium leading-6 text-center text-white uppercase transition bg-blue-700 rounded-full shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none">
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
            >{{ old('description', $project->description) }}</textarea>
        </div>

        <button class="bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50" type="submit">Gardar cambios</button>
    </form>
@endsection
