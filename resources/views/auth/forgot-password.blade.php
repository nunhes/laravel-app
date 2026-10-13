@extends('layouts.app')

@section('title', 'Recuperar contrasinal')

@section('content')
    <div class="mx-auto max-w-md">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
            Recuperar contrasinal
        </h1>

        <p class="mt-2 text-gray-600 dark:text-gray-300">
            Introduce o correo electrónico da túa conta para solicitar
            unha ligazón de recuperación.
        </p>

        @if (session('status'))
            <div class="mt-4 text-sm text-green-700 dark:text-green-300"
                 role="status">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mt-4 text-sm text-red-600 dark:text-red-400"
                 role="alert">
                <ul class="list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST"
              action="{{ route('password.email') }}"
              class="mt-6 space-y-5">
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

            <button type="submit" class="form-button">
                Solicitar ligazón de recuperación
            </button>
        </form>

        <p class="mt-5 text-sm text-gray-600 dark:text-gray-300">
            <a href="{{ route('login') }}"
               class="underline hover:no-underline">
                Volver ao inicio de sesión
            </a>
        </p>
    </div>
@endsection