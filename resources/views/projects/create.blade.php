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
                required
                class="form-input border border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
            >
        </div>

        <div>
            <label for="description">Descrición</label>
            <textarea
                id="description"
                name="description"
                rows="5"
                class="form-textarea border border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
            >{{ old('description') }}</textarea>
        </div>

        <button class="bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50" type="submit">Crear proxecto</button>
    </form>

    <p>
        <a href="{{ route('projects.index') }}" class="px-6 py-2 text-xs font-medium leading-6 text-center text-white uppercase transition bg-blue-700 rounded-full shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none">Volver aos proxectos</a>
    </p>
@endsection
