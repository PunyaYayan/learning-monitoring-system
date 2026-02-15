@php
    $latestReport = $student->reports
        ->sortByDesc(fn($r) => $r->period->start_date ?? $r->created_at)
        ->first();
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Dashboard Siswa
        </h2>
    </x-slot>



    <div class="space-y-5">

        {{-- IDENTITAS --}}
        <x-card class="p-4 rounded-lg">
            <h3 class="text-sm font-semibold">
                {{ $student->fullname }}
            </h3>
            <p class="text-xs text-gray-500">
                Kelas: {{ $class->name ?? '-' }}
                <br>
                Guru: {{ $class->teacher->user->name ?? '-' }}
            </p>
        </x-card>

        {{-- RINGKASAN --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <x-card class="p-4 rounded-lg">
                <div class="text-xs text-gray-500">Total Pertemuan</div>
                <div class="text-sm font-semibold">
                    {{ $totalMeetings }}
                </div>
            </x-card>

            <x-card class="p-4 rounded-lg">
                <div class="text-xs text-gray-500">Kehadiran</div>
                <div class="text-sm font-semibold">
                    {{ $totalMeetings > 0
    ? round(($hadirCount / $totalMeetings) * 100)
    : 0 }}%
                </div>
            </x-card>

            <x-card class="p-4 rounded-lg">
                <div class="text-xs text-gray-500">Pertemuan Terakhir</div>
                <div class="text-sm font-semibold">
                    {{ $lastMeeting
    ? \Carbon\Carbon::parse($lastMeeting->meeting_date)->format('d M Y')
    : '-' }}
                </div>
            </x-card>

            <x-card class="p-4 rounded-lg">
                <div class="text-xs text-gray-500">Status Terakhir</div>
                <div class="text-sm font-semibold capitalize">
                    {{ $lastProgress->progress_label ?? '-' }} ({{ $lastProgress->progress_value ?? '-' }}%)
                </div>
            </x-card>
        </div>

        {{-- RIWAYAT PERTEMUAN --}}
        <x-card class="p-4 rounded-lg">
            <h4 class="text-sm font-semibold mb-3">
                Riwayat Pertemuan
            </h4>

            <table class="w-full text-xs border">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="px-3 py-2">Tanggal</th>
                        <th class="px-3 py-2">Materi</th>
                        <th class="px-3 py-2">Evaluasi</th>
                        <th class="px-3 py-2">Catatan Guru</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($meetings as $meeting)
                        @php
                            $progress = $meeting->progresses
                                ->where('student_id', $student->id)
                                ->first();
                        @endphp

                        <tr class="border-t align-top">
                            <td class="px-3 py-2 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($meeting->meeting_date)->format('d M Y') }}
                            </td>

                            <td class="px-3 py-2">
                                {{ $meeting->material }}
                            </td>

                            <td class="px-3 py-2">
                                @if ($progress)
                                    {{ $progress->progress_label }}
                                    ({{ $progress->progress_value }}%)
                                @else
                                    <span class="text-gray-500">Belum Dinilai</span>
                                @endif
                            </td>

                            <td class="px-3 py-2">
                                {{ $progress->progress_note ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-3 py-4 text-center text-gray-500">
                                Belum ada pertemuan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{ $meetings->links() }}
            </div>

        </x-card>




        {{-- RAPOR (RINGKAS) --}}
        <x-card class="p-4 rounded-lg">
            <h4 class="text-sm font-semibold mb-2">Rapor</h4>

            @if ($latestReport)
                <div class="text-xs space-y-1">
                    <div>
                        <span class="text-gray-500">Periode:</span>
                        {{ $latestReport->period->name ?? '-' }}
                    </div>
                    <div>
                        <span class="text-gray-500">Nilai Akhir:</span>
                        <span class="font-semibold">{{ $latestReport->final_score }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Catatan Guru:</span><br>
                        {{ $latestReport->teacher_note ?? '-' }}
                    </div>
                </div>

                <div class="mt-2">
                    <a href="{{ route('student.reports.print', $latestReport) }}"
                        class="text-xs text-blue-600 hover:underline">
                        Lihat rapor lengkap
                    </a>
                </div>
            @else
                <p class="text-xs text-gray-500">Rapor belum tersedia.</p>
            @endif
        </x-card>
    </div>
</x-app-layout>