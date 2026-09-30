<!DOCTYPE html>
<html lang="gl" class="h-full bg-gray-50 text-gray-900 dark:bg-gray-950 dark:text-gray-100">
<head>
    <meta charset="UTF-8">

    <script>
    (() => {
        const savedTheme = localStorage.getItem('theme');

        const theme = savedTheme === 'dark' || savedTheme === 'light'
            ? savedTheme
            : (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');

        if (theme === 'dark') {
            document.documentElement.classList.add('dark');
        }
    })();
</script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Xestor de proxectos')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full bg-gray-50 text-gray-900 antialiased transition-colors dark:bg-gray-950 dark:text-gray-100">
    <header class="border-b border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
            <a
                href="{{ route('projects.index') }}"
                class="text-lg font-semibold tracking-tight text-gray-900 dark:text-white"
            >
                Xestor de proxectos
            </a>

            <nav class="flex items-center gap-6">
    <a
        href="{{ route('home') }}"
        class="text-sm font-medium text-gray-600 transition hover:text-gray-900 dark:text-gray-300 dark:hover:text-white"
    >
        Inicio
    </a>

    <a
        href="{{ route('projects.index') }}"
        class="text-sm font-medium text-gray-600 transition hover:text-gray-900 dark:text-gray-300 dark:hover:text-white"
    >
        Proxectos
    </a>

    <button
        type="button"
        onclick="setTheme(document.documentElement.classList.contains('dark') ? 'light' : 'dark')"
        class="rounded-md border border-gray-300 px-3 py-1.5 text-sm font-medium text-gray-700 transition hover:bg-gray-100 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-800"
        aria-label="Cambiar tema"
    >
        <span class="dark:hidden">Escuro</span>
        <span class="hidden dark:inline">Claro</span>
    </button>

    @auth
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button
            type="submit"
            class="rounded-md border border-red-300 px-3 py-1.5 text-sm font-medium text-red-700 transition hover:bg-red-50 dark:border-red-800 dark:text-red-300 dark:hover:bg-red-950"
        >
            Pechar sesión
        </button>
    </form>
@endauth
</nav>
        </div>
    </header>

    <main class="mx-auto w-full max-w-6xl px-6 py-8">
        @if (session('success'))
            <div
                class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800"
            >
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div
                class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800"
            >
                <strong class="font-semibold">Hai erros no formulario:</strong>

                <ul class="mt-2 list-inside list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
