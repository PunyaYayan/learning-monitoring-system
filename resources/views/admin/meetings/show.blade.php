<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold">Detail Meeting</h2>
    </x-slot>

    <div class="bg-white shadow rounded-lg p-6 space-y-4">

        <div class="text-sm text-gray-700 space-y-1">
            <p><strong>Tanggal :</strong> {{ $meeting->meeting_date}}</p>
            <p><strong>Kelas :</strong> {{ $meeting->class->name }}</p>
            <p><strong>Guru :</strong> {{ $meeting->teacher->name }}</p>
        </div>

        <div>
            <h3 class="font-semibold text-sm mb-1">Materi</h3>
            <p class="text-sm text-gray-700">
                {{ $meeting->material }}
            </p>
        </div>

        @if ($meeting->notes)
            <div>
                <h3 class="font-semibold text-sm mb-1">Catatan</h3>
                <p class="text-sm text-gray-700">
                    {{ $meeting->notes }}
                </p>
            </div>
        @endif

        <div>
            <a href="{{ route('meetings.index') }}" class="text-sm text-gray-600 hover:underline">
                Kembali
            </a>
        </div>
    </div>
</x-app-layout>