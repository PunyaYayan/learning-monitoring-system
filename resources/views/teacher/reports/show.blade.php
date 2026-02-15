<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Rapor Siswa
        </h2>
    </x-slot>

    <x-card>
        <p class="text-sm">
            <strong>Siswa:</strong> {{ $report->student->fullname }}<br>
            <strong>Periode:</strong> {{ $report->period->name }}
        </p>

        <div class="grid grid-cols-2 gap-4 mt-4 text-sm">
            <div>Listening: {{ $report->listening_score }}</div>
            <div>Speaking: {{ $report->speaking_score }}</div>
            <div>Reading: {{ $report->reading_score }}</div>
            <div>Writing: {{ $report->writing_score }}</div>
            <div class="col-span-2 font-semibold">
                Final Score: {{ $report->final_score }}
            </div>
        </div>

        <div class="mt-4 text-sm">
            <strong>Catatan Guru</strong><br>
            {{ $report->teacher_note ?? '-' }}
        </div>

        <div class="mt-6 flex gap-3">
            @if (!$report->is_locked)
                <a href="{{ route('teacher.reports.edit', $report) }}" class="text-blue-600 hover:underline">
                    Edit
                </a>

                <form method="POST" action="{{ route('teacher.reports.lock', $report) }}">
                    @csrf
                    <button class="text-red-600 hover:underline">
                        Kunci Rapor
                    </button>
                </form>
            @else
                <span class="text-xs text-gray-500">
                    Rapor Final (Terkunci)
                </span>
            @endif
        </div>
    </x-card>
</x-app-layout>