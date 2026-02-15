<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Detail Pertemuan
        </h2>
    </x-slot>

    <div class="space-y-5">

        {{-- INFO MEETING --}}
        <x-card class="p-4 rounded-lg">
            <h3 class="text-sm font-semibold">
                {{ $meeting->class->name }}
            </h3>
            <p class="text-xs text-gray-500">
                {{ \Carbon\Carbon::parse($meeting->meeting_date)->format('d M Y') }}
            </p>

            <div class="mt-3 text-xs">
                <strong>Materi:</strong> {{ $meeting->material }}
            </div>

            <div class="mt-2 text-xs text-gray-600">
                <strong>Catatan Materi:</strong>
                {{ $meeting->note ?? '-' }}
            </div>
        </x-card>

        {{-- PROGRESS ANAK --}}
        @php
            $progress = $meeting->progresses
                ->where('student_id', $student->id)
                ->first();
        @endphp

        <x-card class="p-4 rounded-lg">
            <h4 class="text-sm font-semibold mb-3">
                Progress Anak
            </h4>

            <div class="grid grid-cols-2 gap-4 text-xs mb-3">
                <div>
                    <div class="text-gray-500">Pemahaman</div>
                    <div class="font-semibold capitalize">
                        {{ $progress->progress_label ?? '-' }}
                        ({{ $progress->progress_value ?? '-' }})
                        <!-- @if ($progress->progress_value > 0)
                            {{ $progress->progress_value ?? '-' }}
                        @else
                        {{ 'Tidak Hadir' }}
                        @endif -->
                    </div>
                </div>
                <div class="text-xs text-gray-600">
                    <strong>Catatan Guru:</strong><br>
                    {{ $progress->progress_note ?? '-' }}
                </div>
            </div>
        </x-card>
        {{-- NAVIGASI --}}
        <div>
            <a href="{{ route('parent.students.show', $student) }}" class="text-xs text-gray-600 hover:underline">
                ← Kembali ke Detail Anak
            </a>
        </div>

    </div>
</x-app-layout>