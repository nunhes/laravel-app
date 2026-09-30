@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <div>
        <h1>Xestor de proxectos</h1>

        <p>
            Consulta os proxectos e as tarefas do equipo.
        </p>

        <p>
            <a href="{{ route('projects.index') }}">
                Ver proxectos
            </a>
        </p>
    </div>
@endsection
