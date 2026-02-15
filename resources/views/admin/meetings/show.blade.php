<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold">Detail Meeting</h2>
    </x-slot>

    <div class="bg-white shadow rounded-lg p-6 space-y-4">

        <div class="text-sm text-gray-700 space-y-1">
            <p><strong>Tanggal :</strong> {{ $meeting->meeting_date->locale('id')->translatedFormat('d F Y')}}</p>
            <p><strong>Kelas :</strong> {{ $meeting->class->name }}</p>
            <p><strong>Guru :</strong> {{ $meeting->teacher->user->name }}</p>
        </div>

        <div>
            <h3 class="font-semibold text-sm mb-1">Materi</h3>
            <p class="text-sm text-gray-700">
                {{ $meeting->material }}
            </p>
        </div>

        {{-- Status Siswa --}}
        <div class="mt-6">
            <h3 class="font-semibold text-sm mb-2">Status Siswa</h3>

            @if ($progresses->isEmpty())
                <p class="text-sm text-gray-500">
                    Belum ada data progres siswa pada pertemuan ini.
                </p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm border">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-3 py-2 text-left">Nama Siswa</th>
                                <th class="px-3 py-2 text-left">Status</th>
                                <th class="px-3 py-2 text-left">Catatan Progres</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($progresses as $progress)
                                <tr class="border-b align-top">
                                    <td class="px-3 py-2">
                                        {{ $progress->student->fullname }}
                                    </td>

                                    <td class="px-3 py-2 whitespace-nowrap">
                                        @php
                                            $value = $progress->progress_value;

                                            $badgeClass = match (true) {
                                                $value === null => 'bg-gray-100 text-gray-700',
                                                $value === 0 => 'bg-red-100 text-red-700',
                                                $value < 60 => 'bg-yellow-100 text-yellow-700',
                                                $value < 80 => 'bg-blue-100 text-blue-700',
                                                default => 'bg-green-100 text-green-700',
                                            };

                                            $label = $progress->progress_label;
                                        @endphp

                                        <span class="inline-block px-2 py-1 rounded text-xs {{ $badgeClass }}">
                                            {{ $label }}{{ $value !== null ? " ({$value}%)" : '' }}
                                        </span>
                                    </td>


                                    <td class="px-3 py-2">
                                        {{ $progress->progress_note ?? '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>


        <div>
            <a href="{{ route('admin.meetings.index') }}" class="text-sm text-gray-600 hover:underline">
                Kembali
            </a>
        </div>
    </div>
</x-app-layout>