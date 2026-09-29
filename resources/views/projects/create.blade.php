@extends('layouts.app')

@section('title', 'Crear proxecto')

@section('content')
    <h1>Crear proxecto</h1>

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
@endsection
