@extends('layouts.app')

@section('title', 'Establecer novo contrasinal')

@section('content')
    <div class="mx-auto max-w-md">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
            Establecer novo contrasinal
        </h1>

        <p class="mt-2 text-gray-600 dark:text-gray-300">
            Introduce o teu correo e escolle un contrasinal novo.
        </p>

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
              action="{{ route('password.update') }}"
              class="mt-6 space-y-5">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <label for="email" class="form-label">
                    Correo electrónico
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $email) }}"
                    class="form-input"
                    autocomplete="email"
                    required
                    autofocus
                >
            </div>

            <div>
                <label for="password" class="form-label">
                    Novo contrasinal
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-input"
                    autocomplete="new-password"
                    minlength="12"
                    required
                >

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                    Debe ter polo menos 12 caracteres.
                </p>
            </div>

            <div>
                <label for="password_confirmation" class="form-label">
                    Confirmar contrasinal
                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    class="form-input"
                    autocomplete="new-password"
                    minlength="12"
                    required
                >
            </div>

            <button type="submit" class="form-button">
                Gardar novo contrasinal
            </button>
        </form>
    </div>
@endsection