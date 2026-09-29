@extends('layouts.app')

@section('title', 'Proxectos')

@section('content')
    <h1>Proxectos</h1>

    <p>
        <a href="{{ route('projects.create') }}">
            Crear proxecto
        </a>
    </p>

    @if ($projects->isEmpty())
        <p>Aínda non hai proxectos.</p>
    @else
        <ul>
            @foreach ($projects as $project)
                <li>
                    <strong>
                        <a href="{{ route('projects.show', $project) }}">
                            {{ $project->name }}
                        </a>
                    </strong>

                    — {{ $project->tasks_count }} tarefas

                    @if ($project->description)
                        <p>{{ $project->description }}</p>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
@endsection
