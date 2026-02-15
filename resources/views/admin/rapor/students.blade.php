<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Rapor Siswa – {{ $class->name }}
        </h2>
    </x-slot>

    <x-card>
        <p class="text-sm mb-4">
            Periode:
            <strong>{{ $period->name }}</strong>
        </p>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm border">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-3 py-2 text-left">Nama Siswa</th>
                        <th class="px-3 py-2 text-left">Status Rapor</th>
                        <th class="px-3 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        @php
                            $hasReport = $student->reports->isNotEmpty();
                        @endphp
                        <tr class="border-b">
                            <td class="px-3 py-2">
                                {{ $student->fullname }}
                            </td>
                            <td class="px-3 py-2">
                                @if ($hasReport)
                                    <span class="text-green-600">Ada</span>
                                @else
                                    <span class="text-yellow-600">Belum</span>
                                @endif
                            </td>
                            <td class="px-3 py-2">
                                <a href="{{ route('admin.rapor.print', $student) }}"
                                    class="text-sm text-blue-600 hover:underline">
                                    Lihat Rapor
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-card>
</x-app-layout>