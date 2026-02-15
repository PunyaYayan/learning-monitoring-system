<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Edit Meeting — {{ $class->name }}
        </h2>
    </x-slot>

    <x-card>
        <form method="POST" action="{{ route('teacher.classes.meetings.update', [$class, $meeting]) }}">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <div>
                    <x-input-label value="Tanggal Meeting" />
                    <x-text-input type="date" name="meeting_date" class="w-full"
                        value="{{ old('meeting_date', $meeting->meeting_date) }}" required />
                </div>

                <div>
                    <x-input-label value="Materi" />
                    <x-text-input type="text" name="material" class="w-full"
                        value="{{ old('material', $meeting->material) }}" required />
                </div>

                <div>
                    <x-input-label value="Catatan (opsional)" />
                    <textarea name="note" class="w-full border rounded p-2">{{ old('note', $meeting->notes) }}</textarea>
                </div>
            </div>

            <div class="mt-6 flex gap-3">
                <x-primary-button>Simpan Perubahan</x-primary-button>
                <a href="{{ route('teacher.classes.show', $class) }}" class="text-sm text-gray-600">
                    Batal
                </a>
            </div>
        </form>
    </x-card>
</x-app-layout>
