<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">Rapor Siswa</h2>
    </x-slot>

    <div class="space-y-5">

        {{-- IDENTITAS --}}
        <x-card class="p-4 rounded-lg">
            <h3 class="text-sm font-semibold">{{ $student->fullname }}</h3>
            <p class="text-xs text-gray-500">
                Periode: {{ $period->name ?? '-' }}
            </p>
        </x-card>

        {{-- NILAI AKHIR --}}
        <x-card class="p-4 rounded-lg">
            <div class="grid grid-cols-2 gap-4 text-xs">
                <div>
                    <div class="text-gray-500">Nilai Akhir</div>
                    <div class="text-sm font-semibold">{{ $report->final_score }}</div>
                </div>
                <div>
                    <div class="text-gray-500">Catatan Guru</div>
                    <div>{{ $report->teacher_note ?? '-' }}</div>
                </div>
            </div>
        </x-card>

        {{-- PROGRES DALAM PERIODE --}}
        <x-card class="p-4 rounded-lg">
            <h4 class="text-sm font-semibold mb-3">Progres Pertemuan (Periode Ini)</h4>

            <table class="w-full text-xs border">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="px-3 py-2">Tanggal</th>
                        <th class="px-3 py-2">Materi</th>
                        <th class="px-3 py-2">Evaluasi</th>
                        <th class="px-3 py-2">Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($progresses as $progress)
                        <tr class="border-t align-top">
                            <td class="px-3 py-2 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($progress->meeting->meeting_date)->format('d M Y') }}
                            </td>
                            <td class="px-3 py-2">{{ $progress->meeting->material }}</td>
                            <td class="px-3 py-2">
                                {{ $progress->progress_label }} ({{ $progress->progress_value }}%)
                            </td>
                            <td class="px-3 py-2">{{ $progress->progress_note ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-3 py-4 text-center text-gray-500">
                                Tidak ada progres pada periode ini
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </x-card>

        <div>
            <a href="{{ route('student.dashboard') }}" class="text-xs text-gray-600 hover:underline">
                ← Kembali ke Dashboard
            </a>
            <a href="{{ route('student.reports.print', $report) }}" target="_blank"
                class="text-xs text-blue-600 hover:underline">
                Cetak Rapor
            </a>

        </div>

    </div>
</x-app-layout>