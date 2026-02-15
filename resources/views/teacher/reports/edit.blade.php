<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Edit Rapor
        </h2>
    </x-slot>

    {{-- IDENTITAS SISWA --}}
    <x-card class="mb-4">
        <div class="text-sm grid grid-cols-1 sm:grid-cols-3 gap-2">
            <div>
                <span class="text-gray-500">Nama:</span><br>
                <span class="font-semibold">{{ $report->student->fullname }}</span>
            </div>
            <div>
                <span class="text-gray-500">Kelas:</span><br>
                <span>{{ $report->student->class->name ?? '-' }}</span>
            </div>
            <div>
                <span class="text-gray-500">Periode:</span><br>
                <span>{{ $report->period->name }}</span>
            </div>
        </div>
    </x-card>

    {{-- FORM RAPOR --}}
    <x-card>
        <form method="POST" action="{{ route('teacher.reports.update', $report) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- NILAI --}}
                <div class="space-y-3">
                    <label class="text-sm text-gray-600 mb-1">
                        NILAI
                    </label>
                    <div class="grid grid-cols-3 items-center gap-3">
                        <label class="text-sm text-gray-600">Listening</label>
                        <input type="number" name="listening_score" value="{{ $report->listening_score }}"
                            class="col-span-2 w-full border-gray-300 rounded text-sm" />
                    </div>

                    <div class="grid grid-cols-3 items-center gap-3">
                        <label class="text-sm text-gray-600">Speaking</label>
                        <input type="number" name="speaking_score" value="{{ $report->speaking_score }}"
                            class="col-span-2 w-full border-gray-300 rounded text-sm" />
                    </div>

                    <div class="grid grid-cols-3 items-center gap-3">
                        <label class="text-sm text-gray-600">Reading</label>
                        <input type="number" name="reading_score" value="{{ $report->reading_score }}"
                            class="col-span-2 w-full border-gray-300 rounded text-sm" />
                    </div>

                    <div class="grid grid-cols-3 items-center gap-3">
                        <label class="text-sm text-gray-600">Writing</label>
                        <input type="number" name="writing_score" value="{{ $report->writing_score }}"
                            class="col-span-2 w-full border-gray-300 rounded text-sm" />
                    </div>
                </div>

                {{-- CATATAN GURU --}}
                <div class="flex flex-col">
                    <label class="text-sm text-gray-600 mb-1">
                        Catatan Guru
                    </label>
                    <textarea name="teacher_note" rows="8"
                        class="w-full h-full border-gray-300 rounded p-2 text-sm resize-none">{{ $report->teacher_note }}</textarea>
                </div>

            </div>

            {{-- ACTION --}}
            <div class="flex justify-end mt-4">
                <x-primary-button>
                    Simpan Perubahan
                </x-primary-button>
            </div>
        </form>
    </x-card>
</x-app-layout>