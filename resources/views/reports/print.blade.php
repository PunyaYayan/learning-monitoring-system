<x-app-layout>
    <x-slot name="header">
        <h2 id="page-title" class="font-semibold text-xl text-white">
            Rapor Siswa
        </h2>
    </x-slot>

    {{-- Inline CSS tetap dipertahankan --}}
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .view-mode,
        .print-mode {
            display: none;
        }

        .view-mode.active,
        .print-mode.active {
            display: block;
        }

        .info-section p {
            margin-bottom: 8px;
        }

        .scores-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin: 24px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px 0;
            font-size: 14px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
        }

        @media print {

            header,
            aside,
            nav {
                display: none !important;
            }

            body {
                background: white;
            }

            .print-controls {
                display: none !important;
            }

            .progress-table {
                table-layout: fixed;
            }

            .progress-table th,
            .progress-table td {
                word-wrap: break-word;
                vertical-align: top;
            }

            .progress-table .col-date {
                width: 90px;
                white-space: nowrap;
            }

            .progress-table .col-material {
                width: 120px;
            }

            .progress-table .col-score {
                width: 70px;
                white-space: nowrap;
            }

            .progress-table .col-eval {
                width: 130px;
            }

            .progress-table .col-note {
                width: auto;
            }

        }
    </style>

    <x-card>
        {{-- VIEW MODE --}}
        <div class="view-mode active">
            <div class="info-section text-sm">
                <p><strong>Nama:</strong> {{ $student->fullname }}</p>
                <p><strong>Periode:</strong> {{ $period->name }}</p>
            </div>

            <div class="scores-grid text-sm">
                <p>Listening: {{ $report->listening_score }}</p>
                <p>Speaking: {{ $report->speaking_score }}</p>
                <p>Reading: {{ $report->reading_score }}</p>
                <p>Writing: {{ $report->writing_score }}</p>
                <p class="font-semibold col-span-2">
                    Final Score: {{ $report->final_score }}
                </p>
            </div>

            <div class="text-sm">
                <h3 class="font-semibold mb-1">Catatan Guru</h3>
                <p>{{ $report->teacher_note ?? '-' }}</p>
            </div>
            <br>
            <!-- Riwayat -->
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
            <div class="mt-6">
                <a href="#" onclick="showPrintMode(); return false;" class="text-blue-600 hover:underline text-sm">
                    Cetak Rapor
                </a>
            </div>
        </div>

        {{-- PRINT MODE --}}
        <div class="print-mode">
            <div class="print-controls">
                <button onclick="window.print()" class="px-4 py-2 bg-gray-800 text-white rounded">
                    Print
                </button>
                <button onclick="showViewMode()" class="px-4 py-2 bg-gray-500 text-white rounded ml-2">
                    Kembali
                </button>
            </div>
            <div class="text-center border-b-2 border-black pb-4 mb-6">
                <h1 class="text-xl font-bold">STUDENT REPORTS</h1>
                <p class="mt-2">New Concept English Education Center Kudus</p>
            </div>

            <p><strong>Nama Siswa:</strong> {{ $student->fullname }}</p>
            <p><strong>Periode:</strong> {{ $period->name }}</p>

            <table>
                <thead>
                    <tr>
                        <th>Listening</th>
                        <th>Speaking</th>
                        <th>Reading</th>
                        <th>Writing</th>
                        <th>Final</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $report->listening_score }}</td>
                        <td>{{ $report->speaking_score }}</td>
                        <td>{{ $report->reading_score }}</td>
                        <td>{{ $report->writing_score }}</td>
                        <td class="font-semibold">{{ $report->final_score }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-6">
                <h3 class="font-semibold mb-1">Catatan Guru</h3>
                <p>{{ $report->teacher_note ?? '-' }}</p>
            </div>

            <div class="mt-6 text-sm">
                <h3 class="font-semibold mb-2">Riwayat Progres Pembelajaran</h3>

                <table>
                    <table class="progress-table">
                        <thead>
                            <tr>
                                <th class="col-date">Tanggal</th>
                                <th class="col-material">Materi</th>
                                <th class="col-score">Nilai (%)</th>
                                <th class="col-eval">Evaluasi</th>
                                <th class="col-note">Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($progresses as $progress)
                                @php
                                    $score = $progress->progress_value;

                                    $label = $progress->progress_label;
                                @endphp
                                <tr>
                                    <td class="col-date">
                                        {{ \Carbon\Carbon::parse($progress->meeting->meeting_date)->format('d M Y') }}
                                    </td>
                                    <td class="col-material">
                                        {{ $progress->meeting->material }}
                                    </td>
                                    <td class="col-score">
                                        {{ $score }}%
                                    </td>
                                    <td class="col-eval">
                                        {{ $label }}
                                    </td>
                                    <td class="col-note">
                                        {{ $progress->progress_note ?? '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">Belum ada data progres.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
            </div>


            <div class="flex justify-between mt-16 text-sm">
                <div class="text-center">
                    <p class="mb-1"><br></p>
                    <p class="mb-12">Orang Tua/Wali</p>
                    <div class="border-t border-black w-48 mx-auto">
                        {{ $student->parent->user->name ?? $student->user->name}}
                    </div>
                </div>
                <div class="text-center">
                    <p class="mb-1">{{ now()->locale('id')->isoFormat('D MMMM YYYY') }}</p>
                    <p class="mb-12">Guru Pengajar</p>
                    <div class="border-t border-black w-48 mx-auto">
                        {{ $progresses[0]->meeting->class->teacher->user->name}}
                    </div>

                </div>
            </div>
        </div>
    </x-card>

    <script>
        function showPrintMode() {
            document.querySelector('.view-mode').classList.remove('active');
            document.querySelector('.print-mode').classList.add('active');
            document.getElementById('page-title').textContent = 'Cetak Rapor';
        }

        function showViewMode() {
            document.querySelector('.print-mode').classList.remove('active');
            document.querySelector('.view-mode').classList.add('active');
            document.getElementById('page-title').textContent = 'Rapor Siswa';
        }
    </script>
</x-app-layout>