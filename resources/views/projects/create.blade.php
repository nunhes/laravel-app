@extends('layouts.app')

@section('title', 'Crear proxecto')

@section('content')
    <h1>Crear proxecto</h1>

    <form method="POST" action="{{ route('projects.store') }}">
        @csrf

        <div>
            <label for="name" class="form-label">Nome</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                class="form-input"
                required
            >
        </div>

        <div>
            <label for="description">Descrición</label>
            <textarea
                id="description"
                name="description"
                rows="5"
                class="form-textarea"
            >{{ old('description') }}</textarea>
        </div>

        <button type="submit">Crear proxecto</button>
    </form>

    <p>
        <a href="{{ route('projects.index') }}">Volver aos proxectos</a>
    </p>
@endsection
