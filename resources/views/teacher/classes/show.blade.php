<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            {{ $class->name }}
        </h2>
    </x-slot>

    <x-card>

        {{-- ===================== --}}
        {{-- DETAIL KELAS --}}
        {{-- ===================== --}}
        <div class="mb-8">
            <h3 class="text-lg font-semibold mb-1">Detail Kelas</h3>
            <p class="text-sm text-gray-500 mb-4">
                Informasi umum kelas dan daftar siswa.
            </p>

            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-gray-500">Nama Kelas</span>
                    <div class="font-medium">{{ $class->name }}</div>
                </div>

                <div>
                    <span class="text-gray-500">Guru Pengampu</span>
                    <div class="font-medium">
                        {{ $class->teacher->user->name}}
                    </div>
                </div>

                <div>
                    <span class="text-gray-500">Keterangan Kelas</span>
                    <div class="font-medium">{{ $class->schedule_note ?? '-' }}</div>
                </div>

                <div>
                    <span class="text-gray-500">Level</span>
                    <div class="font-medium">
                        {{ $class->level_label }}
                    </div>
                </div>
            </div>


        </div>

        {{-- ===================== --}}
        {{-- DAFTAR SISWA --}}
        {{-- ===================== --}}
        <div class="mb-10">
            <h4 class="font-semibold mb-3">Daftar Siswa</h4>

            <div class="border rounded overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 text-left">
                        <tr>
                            <th class="px-4 py-2">No</th>
                            <th class="px-4 py-2">Nama</th>
                            <th class="px-4 py-2">Sekolah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($class->students as $student)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2">{{ $student->fullname }}</td>
                                <td class="px-4 py-2">{{ $student->school ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-4 text-center text-gray-500">
                                    Belum ada siswa
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ===================== --}}
        {{-- RIWAYAT MEETING --}}
        {{-- ===================== --}}
        <div>
            <div class="flex items-center justify-between mb-4">
                <h4 class="font-semibold">Riwayat Pertemuan</h4>

                <a href="{{ route('teacher.classes.meetings.create', $class) }}">
                    <x-primary-button>
                        Tambah Meeting
                    </x-primary-button>
                </a>
            </div>

            <div class="border rounded overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 text-left">
                        <tr>
                            <th class="px-4 py-2">Tanggal</th>
                            <th class="px-4 py-2">Materi</th>
                            <th class="px-4 py-2">Hadir</th>
                            <th class="px-4 py-2">Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($meetings as $meeting)
                            <tr class="border-t cursor-pointer hover:bg-gray-50"
                                onclick="window.location='{{ route('teacher.classes.meetings.show', [$class, $meeting]) }}'">

                                <td class="px-4 py-2">
                                    {{ \Carbon\Carbon::parse($meeting->meeting_date)->format('d M Y') }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ $meeting->material }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ $meeting->hadir_count }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ Str::limit($meeting->note, 50) ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                                    Belum ada pertemuan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
                <div class="mt-4">
                    {{ $meetings->links() }}
                </div>

            </div>
        </div>

    </x-card>
</x-app-layout>