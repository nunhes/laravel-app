@extends('layouts.app')

@section('title', 'Iniciar sesión')

@section('content')
    <div class="mx-auto max-w-md">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
            Iniciar sesión
        </h1>

        <p class="mt-2 text-gray-600 dark:text-gray-300">
            Inicia sesión para administrar proxectos e tarefas.
        </p>

        <form method="POST" action="{{ route('login.store') }}" class="mt-6 space-y-5">
            @csrf

            <div>
                <label for="email" class="form-label">
                    Correo electrónico
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="form-input"
                    autocomplete="email"
                    required
                    autofocus
                >
            </div>

            <div>
                <label for="password" class="form-label">
                    Contrasinal
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-input"
                    autocomplete="current-password"
                    required
                >
            </div>

            <button type="submit" class="form-button">
                Iniciar sesión
            </button>
        </form>
    </div>
@endsection
