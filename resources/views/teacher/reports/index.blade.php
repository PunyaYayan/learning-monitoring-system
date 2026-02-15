<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Rapor Siswa
        </h2>
    </x-slot>

    <div class="mb-4 text-sm">
        <strong>Periode:</strong> {{ $activePeriod->name }}
    </div>

    @foreach ($classes as $class)
        <x-card class="p-4 mb-5 rounded-lg">
            <h3 class="font-semibold text-sm mb-3">
                Kelas {{ $class->name }}
            </h3>

            <table class="w-full text-xs border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-3 py-2 text-left">Siswa</th>
                        <th class="px-3 py-2 text-left">Status</th>
                        <th class="px-3 py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($class->students as $student)
                        @php
                            $report = $student->reports->first();
                        @endphp
                        <tr class="border-t">
                            <td class="px-3 py-2">
                                {{ $student->fullname }}
                            </td>

                            <td class="px-3 py-2">
                                {{ $report ? 'Sudah Dinilai' : 'Belum Dinilai' }}
                            </td>

                            <td class="px-3 py-2 text-right">
                                @if ($report)
                                    <a href="{{ route('teacher.reports.show', $report) }}" class="text-blue-600 hover:underline">
                                        Lihat
                                    </a>
                                @else
                                    <a href="{{ route('teacher.reports.create', $student) }}"
                                        class="text-green-600 hover:underline">
                                        Input Rapor
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-card>
    @endforeach
</x-app-layout>