@extends('layouts.app')

@section('title', 'Proxectos')

@section('content')
    <div class="mb-8 flex items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                Proxectos
            </h1>

            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                Organiza o teu traballo e as tarefas de cada proxecto.
            </p>
        </div>

        <a
            href="{{ route('projects.create') }}"
            class="inline-flex items-center rounded-lg bg-gray-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-gray-700"
        >
            Crear proxecto
        </a>
    </div>

    @if ($projects->isEmpty())
        <div class="rounded-xl border border-dashed border-gray-300 bg-white px-6 py-12 text-center">
            <h2 class="text-lg font-semibold text-gray-900">
                Aínda non hai proxectos.
            </h2>

            <p class="mt-2 text-sm text-gray-600">
                Crea o teu primeiro proxecto para comezar a organizar tarefas.
            </p>

            <a
                href="{{ route('projects.create') }}"
                class="mt-5 inline-flex rounded-lg bg-gray-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-700"
            >
                Crear o primeiro proxecto
            </a>
        </div>
    @else
        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($projects as $project)
                <article class="flex flex-col rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex-1">
                        <h2 class="text-lg font-semibold text-gray-950">
                            <a
                                href="{{ route('projects.show', $project) }}"
                                class="transition hover:text-gray-600"
                            >
                                {{ $project->name }}
                            </a>
                        </h2>

                        @if ($project->description)
                            <p class="mt-2 text-sm leading-6 text-gray-600">
                                {{ $project->description }}
                            </p>
                        @else
                            <p class="mt-2 text-sm italic text-gray-400">
                                Sen descrición.
                            </p>
                        @endif
                    </div>

                    <div class="mt-6 flex items-center justify-between border-t border-gray-100 pt-4">
                        <span class="text-sm text-gray-500">
                            {{ $project->tasks_count }}
                            {{ $project->tasks_count === 1 ? 'tarefa' : 'tarefas' }}
                        </span>

                        <a
                            href="{{ route('projects.show', $project) }}"
                            class="text-sm font-semibold text-gray-900 hover:text-gray-600"
                        >
                            Ver proxecto →
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
@endsection
