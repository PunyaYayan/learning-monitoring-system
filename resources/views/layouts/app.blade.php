<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Monitoring Kursus') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-brand-bg text-brand-text antialiased">

    <div class="min-h-screen">
        @include('layouts.navigation')

        @isset($header)
            <header class="bg-brand-header text-white shadow-sm">
                <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                {{-- FLASH MESSAGE --}}
                @if (session('success'))
                    <div class="mb-6 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-red-800">
                        {{ session('error') }}
                    </div>
                @endif

                {{ $slot }}
            </div>
        </main>

    </div>

</body>

</html>