@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <div class="text-center">
        <h1 class="text-3xl">Xestor de proxectos</h1>

        <p class="mt-5">
            Consulta os proxectos e as tarefas do equipo.
        </p>

        <p class="mt-5">
            <a href="{{ route('projects.index') }}" class="m-5 p-3 rounded-lg bg-cyan-500 hover:bg-cyan-800">
                Ver proxectos
            </a>
        </p>
    </div>
@endsection
