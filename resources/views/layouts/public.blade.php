<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'PPDB' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Dashboard Siswa
        </h2>
    </x-slot>
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 h-16 flex items-center">
            <a href="/" class="flex items-center gap-2">
                <x-application-logo class="block h-9 w-auto text-gray-800" />
            </a>

            <div class="ml-auto">
                <p class="text-sm font-medium text-blue-600">
                    PPDB
                </p>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-8">
        {{ $slot }}
    </main>

</body>

</html>