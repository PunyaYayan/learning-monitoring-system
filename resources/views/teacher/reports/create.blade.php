<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Input Rapor
        </h2>
    </x-slot>

    <x-card>
        <div class="mb-4 text-sm">
            <strong>Siswa:</strong> {{ $student->fullname }} <br>
            <strong>Periode:</strong> {{ $period->name }}
        </div>

        <form method="POST" action="{{ route('teacher.reports.store', $student) }}" class="space-y-4">
            @csrf

            <x-input label="Listening" name="listening_score" type="number" />
            <x-input label="Speaking" name="speaking_score" type="number" />
            <x-input label="Reading" name="reading_score" type="number" />
            <x-input label="Writing" name="writing_score" type="number" />

            <div>
                <x-input-label value="Catatan Guru" />
                <textarea name="teacher_note" class="w-full border rounded p-2 text-sm"></textarea>
            </div>

            <x-primary-button>Simpan Rapor</x-primary-button>
        </form>
    </x-card>
</x-app-layout>