<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Dashboard Orang Tua
        </h2>
    </x-slot>

    <div class="space-y-5">

        {{-- IDENTITAS PARENT --}}
        <x-card class="p-4 rounded-lg">
            <div>
                <h3 class="text-sm font-semibold">
                    {{ $parent->fullname }}
                </h3>
                <p class="text-xs text-gray-500">
                    Total Anak: {{ $students->count() }}
                </p>
            </div>
        </x-card>

        {{-- GRID CARD ANAK --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            @forelse ($students as $student)
                    @php
                        $meetings = $student->class?->meetings ?? collect();

                        $totalMeetings = $meetings->count();

                        $progresses = $meetings
                            ->flatMap->progresses
                            ->where('student_id', $student->id);

                        $hadirCount = $progresses
                            ->where('progress_value', '>', 0)->count();

                        $lastMeeting = $meetings->first();

                        $lastProgress = $progresses
                            ->sortByDesc('created_at')
                            ->first();
                    @endphp

                    <x-card class="p-4 rounded-lg">

                        {{-- HEADER ANAK --}}
                        <div class="mb-3">
                            <h4 class="text-sm font-semibold">
                                {{ $student->fullname }} ({{ $student->class->LevelLabel }})
                            </h4>
                            <p class="text-xs text-gray-500">
                                Kelas: {{ $student->class->name ?? '-' }}
                                <br>Guru: {{ $student->class->teacher->user->name ?? '-' }}
                            </p>
                        </div>

                        {{-- RINGKASAN --}}
                        <div class="grid grid-cols-2 gap-3 text-xs mb-3">
                            <div>
                                <div class="text-gray-500">Kehadiran</div>
                                <div class="font-semibold">
                                    {{ $totalMeetings > 0
                ? round(($hadirCount / $totalMeetings) * 100)
                : 0 }}%
                                </div>
                            </div>

                            <div>
                                <div class="text-gray-500">Total Pertemuan</div>
                                <div class="font-semibold">
                                    {{ $totalMeetings }}
                                </div>
                            </div>

                            <div>
                                <div class="text-gray-500">Pertemuan Terakhir</div>
                                <div class="font-semibold">
                                    {{ $lastMeeting
                ? \Carbon\Carbon::parse($lastMeeting->meeting_date)->format('d M Y')
                : '-' }}
                                </div>
                            </div>

                            <div>
                                <div class="text-gray-500">Pemahaman Pertemuan Terakhir</div>
                                <div class="font-semibold capitalize">
                                    {{  $lastProgress->progressLabel}}
                                    ({{ $lastProgress->progress_value . '%' }})

                                    <!-- @if ($lastProgress->progress_value != 0)
                                                                {{ $lastProgress->progress_value . '%' }}
                                                            @elseif($lastProgress->progress_value == 0)
                                                                {{ 'Tidak hadir' }}
                                                            @else
                                                                {{ 'Belum ada Pertemuan Terakhir' }}
                                                            @endif -->

                                </div>
                            </div>
                        </div>

                        {{-- MATERI TERAKHIR --}}
                        <div class="text-xs text-gray-600 mb-3 truncate">
                            <strong>Materi:</strong>
                            {{ $lastMeeting->material ?? '-' }}
                        </div>

                        {{-- AKSI --}}
                        <div class="flex justify-end">
                            <a href="{{ route('parent.students.show', $student) }}"
                                class="text-blue-600 hover:underline text-xs font-medium">
                                Lihat Detail Anak
                            </a>
                        </div>

                    </x-card>

            @empty
                <x-card class="p-4 rounded-lg">
                    <p class="text-xs text-gray-500">
                        Tidak ada data anak.
                    </p>
                </x-card>
            @endforelse

        </div>

    </div>
</x-app-layout>