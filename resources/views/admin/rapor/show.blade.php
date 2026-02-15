<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Rapor Siswa
        </h2>
    </x-slot>

    <x-card class="space-y-4">
        <div class="text-sm">
            <p><strong>Nama:</strong> {{ $student->fullname }}</p>
            <p><strong>Periode:</strong> {{ $period->name }}</p>
        </div>

        @if ($report)
            <div class="grid grid-cols-2 gap-4 text-sm">
                <p>Listening: {{ $report->listening_score }}</p>
                <p>Speaking: {{ $report->speaking_score }}</p>
                <p>Reading: {{ $report->reading_score }}</p>
                <p>Writing: {{ $report->writing_score }}</p>
                <p class="col-span-2 font-semibold">
                    Final Score: {{ $report->final_score }}
                </p>
            </div>

            <div>
                <h3 class="font-semibold text-sm mb-1">Catatan Guru</h3>
                <p class="text-sm text-gray-700">
                    {{ $report->teacher_note ?? '-' }}
                </p>
            </div>

            <div class="pt-4">
                <a href="{{ route('admin.rapor.print', $student) }}" class="text-sm text-blue-600 hover:underline">
                    Cetak Rapor
                </a>
            </div>
        @else
            <p class="text-sm text-gray-500">
                Rapor belum tersedia untuk siswa ini.
            </p>
        @endif
    </x-card>
</x-app-layout>