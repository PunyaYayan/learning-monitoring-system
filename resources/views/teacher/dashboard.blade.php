<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Dashboard Guru
        </h2>
    </x-slot>

    {{-- Welcome --}}
    <x-card class="mb-6">
        <h3 class="text-lg font-semibold mb-1">
            Selamat datang, {{ auth()->user()->name }}
        </h3>
        <p class="text-sm text-gray-600">
            Kelola pertemuan dan progres siswa dari sini.
        </p>
    </x-card>

    {{-- Ringkasan --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <x-card>
            <p class="text-sm text-gray-500">Jumlah Kelas</p>
            <p class="text-2xl font-semibold">{{ $classes->count() }}</p>
        </x-card>

        <x-card>
            <p class="text-sm text-gray-500">Meeting Terbaru</p>
            <p class="text-2xl font-semibold">{{ $meetings->count() }}</p>
        </x-card>

        <x-card>
            <p class="text-sm text-gray-500">Periode Rapor</p>
            <p class="text-lg font-semibold">
                {{ $activePeriod ? $activePeriod->name : 'Tidak Aktif' }}
            </p>
            @if ($activePeriod)
                <a href="{{ route('teacher.reports.index') }}"
                    class="inline-block mt-3 text-sm text-blue-600 hover:underline">
                    Kelola Rapor
                </a>
            @else
                <p class="mt-3 text-xs text-gray-400">
                    Hubungi admin untuk mengaktifkan periode rapor
                </p>
            @endif
        </x-card>
    </div>

    {{-- Kelas yang Diajar --}}
    <x-card class="mb-8">
        <h3 class="font-semibold mb-4">Kelas yang Diajar</h3>

        @if ($classes->isEmpty())
            <p class="text-sm text-gray-500">
                Anda belum ditugaskan ke kelas mana pun.
            </p>
        @else
            <ul class="divide-y">
                @foreach ($classes as $class)
                    <li class="py-3 flex justify-between items-center">
                        <div>
                            <p class="font-medium">{{ $class->name }}</p>
                            <p class="text-sm text-gray-500">
                                {{ $class->level_label }}
                            </p>
                        </div>
                        <a href="{{ route('teacher.classes.show', ['class' => $class]) }}"
                            class="text-sm text-blue-600 hover:underline">
                            Lihat Meeting
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </x-card>

    {{-- Meeting Terbaru --}}
    <x-card>
        <h3 class="font-semibold mb-4">Meeting Terbaru</h3>

        @if ($meetings->isEmpty())
            <p class="text-sm text-gray-500">
                Belum ada meeting.
            </p>
        @else
            <ul class="divide-y">
                @foreach ($meetings as $meeting)
                    <li class="py-3 flex justify-between items-center">
                        <div>
                            <p class="font-medium">
                                {{ $meeting->class->name }}
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ $meeting->meeting_date->format('d-m-Y') }}
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ $meeting->note ?? '-'}}
                            </p>
                        </div>
                        <!-- <a href="{{ route('teacher.classes.index', $meeting) }}" class="text-sm text-blue-600 hover:underline">
                                            Detail
                                        </a> -->
                        <a href="{{ route('teacher.classes.meetings.show', [$class, $meeting]) }}"
                            class="text-sm text-blue-600 hover:underline">
                            Detail
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </x-card>

</x-app-layout>