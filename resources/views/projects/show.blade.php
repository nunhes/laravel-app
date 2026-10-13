@extends('layouts.app')

@section('title', $project->name)

@section('content')
    <p class="m-b-6">
        <a href="{{ route('projects.index') }}" class="px-6 py-2 text-xs font-medium leading-6 text-center text-white uppercase transition bg-blue-700 rounded-full shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none">← Volver aos proxectos</a>
    </p>

    <article class="flex inline-flex justify-between border">
<div>
    <h1 class="text-3xl">{{ $project->name }}</h1>
<div class="flex inline-flex justify-between">
    @if ($project->description)
        <p>{{ $project->description }}</p>
    @endif


    <p>
        <a href="{{ route('projects.edit', $project) }}" class="bg-green-300 p-0.5">
           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3" title="Editar proxecto">
           <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
           </svg>
        </a>
    </p>

    <form method="POST" action="{{ route('projects.destroy', $project) }}">
        @csrf
        @method('DELETE')

        <button type="submit" aria-label="Eliminar proxecto"><svg xmlns="http://www.w3.org/2000/svg" class="size-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
            </svg>
        </button>
    </form>
</div>
</div>
    </article>
<hr>
<article class="">
    <div class="flex inline-flex justify-between">
    <h2 class="text-2xl">Tarefas</h2>

    <p>
        <a href="{{ route('projects.tasks.create', $project) }}"  aria-label="Crear tarefa">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
</svg>
<span class="sr-only">Crear tarefa</span>
        </a>
    </p>
    </div>
</article>
    @if ($project->tasks->isEmpty())
        <p>Este proxecto aínda non ten tarefas.</p>
    @else
        <ul>
            @foreach ($project->tasks as $task)
                <li>&middot;
                    <strong>{{ $task->title }}</strong>
                    — {{ $task->status }}
                    — prioridade {{ $task->priority }}
                </li>
            @endforeach
        </ul>

        <p class="p-2 rounded-sm bg-green-300">
            <a href="{{ route('projects.tasks.index', $project) }}">
                Ver todas as tarefas
            </a>
        </p>
    @endif
@endsection
