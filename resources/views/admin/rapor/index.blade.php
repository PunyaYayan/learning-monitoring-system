<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Monitoring Rapor
        </h2>
    </x-slot>

    <x-card>
        @if (!$period)
            <p class="text-sm text-gray-600">
                Belum ada periode rapor aktif.
            </p>
        @else
            <p class="text-sm mb-4">
                Periode aktif:
                <strong>{{ $period->name }}</strong>
            </p>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm border">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-3 py-2 text-left">Kelas</th>
                            <th class="px-3 py-2 text-left">Total Siswa</th>
                            <th class="px-3 py-2 text-left">Sudah Rapor</th>
                            <th class="px-3 py-2 text-left">Status</th>
                            <th class="px-3 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classes as $class)
                            <tr class="border-b">
                                <td class="px-3 py-2">
                                    {{ $class->name }}
                                </td>
                                <td class="px-3 py-2">
                                    {{ $class->students_count }}
                                </td>
                                <td class="px-3 py-2">
                                    {{ $class->reported_students_count }}
                                </td>
                                <td class="px-3 py-2">
                                    @if ($class->students_count === $class->reported_students_count)
                                        <span class="text-green-600 font-medium">Lengkap</span>
                                    @else
                                        <span class="text-yellow-600 font-medium">Belum Lengkap</span>
                                    @endif
                                </td>
                                <td class="px-3 py-2">
                                    <a href="{{ route('admin.rapor.students', $class) }}"
                                       class="text-sm text-blue-600 hover:underline">
                                        Lihat Siswa
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </x-card>
</x-app-layout>