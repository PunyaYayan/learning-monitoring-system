<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Detail Meeting
        </h2>
    </x-slot>

    <x-card class="space-y-3">
        <p><strong>Kelas:</strong> {{ $class->name }}</p>
        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($meeting->meeting_date)->format('d-m-Y') }}
        </p>
        <p><strong>Materi:</strong> {{ $meeting->material }}</p>

        @if ($meeting->notes)
            <p><strong>Catatan:</strong> {{ $meeting->notes }}</p>
        @endif
        {{-- ===================== --}}
        {{-- PROGRESS SISWA --}}
        {{-- ===================== --}}
        <div class="mb-8">
            <div class="flex justify-between items-center mb-4">
                <h4 class="font-semibold">Progress Siswa</h4>

                <a href="{{ route('teacher.meetings.progress.create', $meeting) }}"
                    class="text-sm text-green-600 hover:underline">
                    Input / Edit Progress
                </a>
            </div>

            <div class="border rounded overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 text-left">
                        <tr>
                            <th class="px-4 py-2">No</th>
                            <th class="px-4 py-2">Nama Siswa</th>
                            <th class="px-4 py-2">Progress (%)</th>
                            <th class="px-4 py-2">Keterangan</th>
                            <th class="px-4 py-2">Catatan</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($meeting->progresses as $item)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $loop->iteration }}</td>

                                <td class="px-4 py-2">
                                    {{ $item->student->fullname }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ $item->progress_value }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ $item->progress_label }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ $item->progress_note ?? '-' }}
                                </td>
                            </tr>
                        @empty

                            <tr>
                                <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                                    Progress belum diisi
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex gap-3 mt-4">
            <a href="{{ route('teacher.classes.meetings.edit', [$class, $meeting]) }}" class="text-blue-600 text-sm">
                Edit
            </a>

            <form method="POST" action="{{ route('teacher.classes.meetings.destroy', [$class, $meeting]) }}"
                onsubmit="return confirm('Hapus meeting ini?')">
                @csrf
                @method('DELETE')
                <button class="text-red-600 text-sm">Hapus</button>
            </form>

            <a href="{{ route('teacher.classes.show', $class) }}" class="text-sm text-gray-600">
                Kembali ke Kelas
            </a>
        </div>
    </x-card>
</x-app-layout>